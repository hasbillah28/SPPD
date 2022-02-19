<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\PerjalananDinas;
use App\Models\PerjalananDinasUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class KwintansiController extends Controller
{
    const MONTH_NAME = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustuts', 'September', 'Oktober', 'November', 'Desember'
    ];
        /*01=tolak
        00=belum
        0=ajukan
        1=acc*/
    public function index() {
        $kwitansis = Kwitansi::orderbyDesc('created_at')->where('status', '!=', '00')->paginate(8);

        return view('admin.perjalanandinas.kwitansi.index', compact('kwitansis'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'uangHarian' => 'required|numeric|min:0',
            'mataAnggaran1' => 'required',
            'mataAnggaran2' => 'required',
            'nomorBukti' => 'nullable'
        ]);

        $kwitansi = Kwitansi::find($id);
        $kwitansi->mata_anggaran_1 = $request->mataAnggaran1;
        $kwitansi->mata_anggaran_2 = $request->mataAnggaran2;
        $kwitansi->uang_harian = $request->uangHarian;
        $kwitansi->nomor_bukti = $request->nomorBukti;
        $kwitansi->status = '1';

        $kwitansi->save();

        $kwitansi2 = Kwitansi::find($id);

        $kwitansiPerjalananDinas = Kwitansi::where('perjalanan_dinas_user_id', $kwitansi2->perjalanan_dinas_user_id)
            ->where('status', '1')
            ->get();

        $countAnggota = $kwitansi2->sppd->perjalanan->anggotas->count();
        $idperjalanan = $kwitansi2->sppd->perjalanan_dinas_id;
        $countKwitansi =DB::table('kwitansi')
            ->join('perjalanan_dinas_user', 'perjalanan_dinas_user.id', '=', 'kwitansi.perjalanan_dinas_user_id')
            ->join('perjalanan_dinas', 'perjalanan_dinas.id', '=', 'perjalanan_dinas_user.perjalanan_dinas_id')
            ->where('kwitansi.status', '1')
            ->where('perjalanan_dinas.id',$idperjalanan)
            ->count();

        if ($countAnggota == $countKwitansi) {
            $perjalananDinas = PerjalananDinas::find($kwitansi2->sppd->perjalanan_dinas_id);

            $perjalananDinas->status = config('central.status.0');
            $perjalananDinas->save();

            return redirect()->route('kwitansi.index')->with('success', 'Berhasil membuat kwitansi dan update status perjalanan sudah selesai');
        }

        return redirect()->route('kwitansi.index')->with('success', 'Berhasil membuat kwitansi');
    }

    public function edit($id) {
        $kwitansi = Kwitansi::find($id);

        $perjalanan = $kwitansi->sppd->perjalanan;

        $startDate = date_create($perjalanan->tanggal_berangkat);
        $endDate = date_create($perjalanan->tanggal_kembali);
        $interval = date_diff($startDate, $endDate);
        $dayInterval = ($interval->days) + 1;


        return view('admin.perjalanandinas.kwitansi.edit', compact('kwitansi', 'dayInterval'));
    }

    public function tolakBukti($id) {
        $kwitansi = Kwitansi::find($id);

        $kwitansi->status = '01';
        $kwitansi->bukti_sppd = null;

        $kwitansi->save();

        return redirect()->route('kwitansi.index')->with('success', 'Berhasil menolak bukti pengajuan kwitansi');
    }

    public function showFile($id) {
        $kwitansi = Kwitansi::find($id);
        $path = $kwitansi->bukti_sppd;

        $paths = Storage::path($path);

//        dd($paths);

        return response()->file($paths);
    }

    public function print($id) {
        $month = date('m');
        $monthName = self::MONTH_NAME[$month - 1];

        $kwitansi = Kwitansi::find($id);

        $perjalanan = $kwitansi->sppd->perjalanan;

        $startDate = date_create($perjalanan->tanggal_berangkat);
        $endDate = date_create($perjalanan->tanggal_kembali);
        $interval = date_diff($startDate, $endDate);
        $dayInterval = ($interval->days) + 1;

        $daySurat = $startDate->format('d');
        $monthSurat = $startDate->format('m');
        $monthSurat = self::MONTH_NAME[$monthSurat - 1];
        $yearSurat = $startDate->format('Y');

        $daySuratsampai = $endDate->format('d');
        $monthSuratsampai = $endDate->format('m');
        $monthSuratsampai = self::MONTH_NAME[$monthSuratsampai - 1];
        $yearSuratsampai = $endDate->format('Y');

        $jumlahUang = $dayInterval * $kwitansi->uang_harian;
        $terbilang = ($this->terbilang($jumlahUang));
        $uangHarian = number_format($kwitansi->uang_harian, '0', ',', '.');

        $jumlahUang = number_format($jumlahUang, '0', ',', '.');

        $pejabat = User::role('ppk')->get();
//        dd($pejabat);

        $bendahara = User::role('bendahara')->get();

        if($kwitansi->status == '0') {
            return redirect()->route('kwitansi.index')->with('error', 'Update isi kwitansi dah terlebihulu');
        }

        return view('admin.perjalanandinas.kwitansi.print', compact('kwitansi', 'jumlahUang', 'uangHarian', 'dayInterval', 'monthName', 'daySurat', 'monthSurat', 'yearSurat', 'terbilang', 'pejabat', 'bendahara','daySuratsampai','monthSuratsampai','yearSuratsampai'));
    }

    public function store(Request $request, $id) {
        $request->validate([
            'upload' => 'required|file|mimes:pdf'
        ]);

        $userId = Auth::user()->id;
        $perjalananDinasUser = PerjalananDinasUser::where('perjalanan_dinas_id', $id)
            ->where('user_id', $userId)
            ->first();

        $kwitansi = Kwitansi::find($perjalananDinasUser->kwitansi->id);
        $kwitansi->status = '0';

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = 'bukti_'.str_replace("/","-",$perjalananDinasUser->no_sppd).'.pdf';
            $filePath = 'public/file/'.$userId.'/bukti';
            $path = $file->storeAs($filePath, $filename);
        }

        $kwitansi->bukti_sppd = $path;

        $kwitansi->save();

        return redirect()->back()->with('success', 'Pengajuan kwitansi selesai');
    }

    private function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    private function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }
}
