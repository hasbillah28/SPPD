<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\PerjalananDinasUser;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerjalananDinasUserController extends Controller
{
    const MONTH_NAME = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustuts', 'September', 'Oktober', 'November', 'Desember'
    ];

    function index() {
        $user = Auth::user();
        $sppd = PerjalananDinasUser::where('user_id', $user->id)->paginate(8);

        return view('pegawai.perjalanan.index', compact('sppd'));
    }

    function store(Request $request, $id)
    {
        $sppd = new PerjalananDinasUser;

        $perjalananUser = PerjalananDinasUser::where('user_id', $request->user_id)
            ->where('perjalanan_dinas_id', $id)
            ->get();

        if ($perjalananUser->count() > 0) {
            return redirect()->back()->with('error', 'User sudah termasuk ke dalam perjalanan dinas');
        }

        $sppd->user_id = $request->user_id;
        $sppd->perjalanan_dinas_id = $id;

        $sppd->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan anggota');;
    }

    function destroy($perjalanan_id, $user_id)
    {
        DB::table('perjalanan_dinas_user')
            ->where([
                ['perjalanan_dinas_id', $perjalanan_id],
                ['user_id', $user_id]
            ])
            ->delete();

        return redirect()->back()->with('error', 'Berhasil menghapus anggota');
    }

    function print($perjalananId, $userId) {
        $perjalananUser = PerjalananDinasUser::where([

            ['perjalanan_dinas_id', $perjalananId],
            ['user_id', $userId]
        ])->get();

        $printDate = date('m');
        $printDate = self::MONTH_NAME[$printDate-1];
        $startDate = date_create($perjalananUser[0]->perjalanan->tanggal_berangkat);
        $endDate = date_create($perjalananUser[0]->perjalanan->tanggal_kembali);
        $interval = date_diff($startDate, $endDate);
        $dayInterval = ($interval->days) + 1;

        $noSppd = "";
        $i = 0;
        $start = 2;
        $nomor = [];

        $pejabat = User::role('ppk')->get();
        $kakan = User::role('kakan')->get();

        foreach ($perjalananUser as $print) {
            $noSppd = $print->no_sppd;
        }

        foreach ($perjalananUser[0]->perjalanan->riwayat as $riwayat) {
            $nomor[$i] = $this->integerToRoman($start);
            $start++;
            $i++;
        }

        $totalRiwayat = $perjalananUser[0]->perjalanan->riwayat->count();

        if ($totalRiwayat < 4) {
            if ($totalRiwayat == 0){
                for ($i=0;$i < 3 ;$i++) {
                    $sisa[$i] = $this->integerToRoman($i + 3);
                }
            }else{
                for ($i=0;$i < 4 - $totalRiwayat;$i++) {
                    $sisa[$i] = $this->integerToRoman($totalRiwayat + $i + 2);
                }
            }

        }
        $sisa = collect($sisa);

        return view('admin.perjalanandinas.anggota.print', compact('noSppd', 'perjalananUser', 'pejabat', 'kakan', 'nomor', 'sisa','dayInterval','printDate'));
    }

    function uploadBukti(Request $request, $perjalananId, $userId) {

        $kwitansi = new Kwitansi();

        $kwitansi->user_id = $userId;
        $kwitansi->perjalanan_dinas_id = $perjalananId;
        $kwitansi->status = '0';

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = 'bukti'.$file->getType();
            $filePath = '/public/app/'.$userId.'/bukti';
            $file->storeAs($filePath, $filename);
            $dir = $filePath.'/'.$filename;
        }

        $kwitansi->bukti_sppd = $dir;

        $kwitansi->save();

        return redirect()->back()->with('success', 'Pengajuan kwitansi selesai');
    }

    function integerToRoman($integer)
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array('M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1);

        foreach($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($integer/$value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman,$matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }
}
