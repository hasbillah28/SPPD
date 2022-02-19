<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\PerjalananDinas;
use App\Models\PerjalananDinasUser;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Notifications\PersetujuanPerjalanan;

class PersetujuanController extends Controller
{
    const MONTH_NAME = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustuts', 'September', 'Oktober', 'November', 'Desember'
    ];

    const MONTH_ROME = [
        'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X','XI', 'XII'
    ];

    public function index() {
        $user = Auth::user();

        if ($user->hasRole('kakan')) {
            $perjalanans = PerjalananDinas::where('status', '=', config('central.status.2'))
                ->orWhere('status', '=', config('central.status.7'))
                ->paginate(5);

            return view('kakan.perjalanan.index', compact('perjalanans'));
        } else if($user->hasRole('kaur')) {
            $perjalanans = PerjalananDinas::where('status', '=', config('central.status.4'))
                ->orWhere('status', '=', config('central.status.6'))
                ->paginate(5);

            return view('kaur.perjalanan.index', compact('perjalanans'));

        } else if($user->hasRole('kasubag')) {
            $perjalanans = PerjalananDinas::where('status', '=', config('central.status.5'))
                ->paginate(5);

            return view('kasubag.perjalanan.index', compact('perjalanans'));
        } else {
            abort(403);
        }
    }

    public function statusCreateToSub($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.01')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }

        if ($perjalananDinas->anggotas->count() <= 0) {
            return redirect()->back()->with('error', 'Perjalanan dinas harus dilakukan minimal oleh satu pegawai');
        }

        $perjalananDinas->status = config('central.status.1');
        $perjalananDinas->save();

        return redirect()->route('pegawai.perjalanan')->with('success', 'Perjalanan diajukan, menunggu persetujuan dan ditanda-tangani kepala kantor');
    }

    public function statusSubToOn($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.1')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }

        $perjalananDinas->status = config('central.status.2');
        $perjalananDinas->save();

        return redirect()->route('perjalanan.index')->with('success', 'Perjalanan '.$id.' menunggu persetujuan kepala kantor');

    }

    public function statusOnToSTAcc($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        $month = date('m');
        $monthRome = self::MONTH_ROME[$month - 1];
        $year = date('Y');

        if ($perjalananDinas->status != config('central.status.2')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }
        $nomorSuratTugas = $this->writeSTugasNum($monthRome, $year);
        $perjalananDinas->status = config('central.status.3');
        $perjalananDinas->no_surat_tugas = $nomorSuratTugas;
        $perjalananDinas->save();

        return redirect()->route('kakan.persetujuan')->with('success', 'Perjalanan '.$id.' Disetujui dengan nomor surat tugas '.$nomorSuratTugas);
    }

    public function statusSTReject(Request $request,$id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.2')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }
        try {

            $perjalananDinas->status = config('central.status.02');
            $perjalananDinas->komentar = $request->review;
            $perjalananDinas->save();
        } catch (Exception $exception) {
            return redirect()->route('kakan.perjalanan.show', $id)->with('error', 'Gagal '.$exception->getMessage());
        }


        return redirect()->route('kakan.persetujuan')->with('success', 'Berhasil menolak perjalanan dinas '.$id);
    }

    public function statusSTAccToOnSPD($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.3') && $perjalananDinas->status != config('central.status.6')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }
        if ($perjalananDinas->anggotas->count() <= 0) {
            return redirect()->back()->with('error', 'Perjalanan dinas harus dilakukan minimal oleh satu pegawai');
        }

        $perjalananDinas->status = config('central.status.4');
        $perjalananDinas->save();

        return redirect()->route('perjalanan.index')->with('success', 'Berhasil mengajukan Permohonan SPPD');
    }

    public function statusOnSPDToReview(Request $request, $id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.4')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }

        $perjalananDinas->komentar = $request->get('review');

        $perjalananDinas->status = config('central.status.6');
        $perjalananDinas->save();

        return redirect()->route('kaur.perjalanan',$id)->with('success', 'Komentar pada perjalanan '.$id.' berhasil di simpan');
    }

    public function statusOnSPDToAccKU($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.4')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }

        $perjalananDinas->status = config('central.status.5');
        $perjalananDinas->save();
        $no_ST=$perjalananDinas->no_surat_tugas;

        return redirect()->route('kaur.perjalanan')->with('success', 'Berhasil Menyetujui Perjalanan'.$id.' dengan nomor surat tugas '.$no_ST);
    }

//    public function statusReviewToOnSPD($id)
//    {
//        $perjalananDinas = PerjalananDinas::find($id);
//
//        if ($perjalananDinas->status != config('central.status.01')) {
//            return redirect()->back()->with('error', 'Status tidak sesuai!!');
//        }
//
//        $perjalananDinas->status = config('central.status.1');
//        $perjalananDinas->save();
//
//        return redirect()->back();
//    }

    public function statusAccKUToAccKs($id) {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.5')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }

        $perjalananDinas->status = config('central.status.7');
        $perjalananDinas->save();
        $no_ST=$perjalananDinas->no_surat_tugas;

        return redirect()->route('kasubag.perjalanan')->with('success', 'Menyetujui Perjalanan '.$id.' dengan nomor surat tugas '.$no_ST);
    }

    public function statusAccKsToAcc($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.7')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }


        try {
            $year = date('Y');
            $this->addSPPDNum($year, $id);

            $perjalananDinas->status = config('central.status.8');
            $perjalananDinas->save();
            $no_ST=$perjalananDinas->no_surat_tugas;

        } catch (Exception $exception) {
            return redirect()->route('kakan.persetujuan')->with('success', 'Error '.$exception->getMessage());

        }

        return redirect()->route('kakan.persetujuan')->with('success', 'Menyetujui Perjalanan '.$id.' dengan nomor surat tugas '.$no_ST);
    }

    public function statusAccToCompleteAcc($id)
    {
        $perjalananDinas = PerjalananDinas::find($id);

        if ($perjalananDinas->status != config('central.status.8')) {
            return redirect()->back()->with('error', 'Status tidak sesuai!!');
        }

        try {
            foreach ($perjalananDinas->anggotas as $anggota) {
                $my_apikey= env('RAPIHWA_APIKEY');
                $name= $anggota->user->name;
                $deskripsi= $anggota->perjalanan->deskripsi;
                $tempat= $anggota->perjalanan->tempat;
                $nohape= $anggota->user->routeNotificationForWhatsapp();
                $message=" Pemberitahuan kepada ".$name." bahwa surat anda dengan deskripsi perjalanan ".$deskripsi." yang bertempat di ".$tempat." sudah bisa diambil ";

                $api_url = "http://panel.rapiwha.com/send_message.php";
                $api_url .= "?apikey=". urlencode ($my_apikey);
                $api_url .= "&number=". urlencode ($nohape);
                $api_url .= "&text=". urlencode ($message);

                $my_result_object = json_decode(file_get_contents($api_url, false));

                $result = [$my_result_object->success , $my_result_object->description , $my_result_object->description];
                json_encode($result);

                $id=substr(md5(mt_rand()), 0, 6);
                $kwitansi = new Kwitansi();
                $kwitansi->id='KUI_'.$id;
                $kwitansi->perjalanan_dinas_user_id = $anggota->id;
                $kwitansi->status = '00';

                $kwitansi->save();
            }

            $perjalananDinas->status = config('central.status.9');
            $perjalananDinas->save();


        } catch (Exception $exception) {
            return redirect()->route('perjalanan.index')->with('error', 'Gagal '.$exception->getMessage());
        }

        return redirect()->route('perjalanan.index')->with('success', 'Proses persetujuan perjalanan '.$perjalananDinas->id.' sudah selesai');
    }


    /*
     * Fungsi addSPPDNum akan menambahkan nomor sppd
     * berdasarkan nomor yang diberikan fungsi writeSPPDNum()
     * fungsi writeSPPDNum() akan dijalankan sesuai dengan jumlah user pada
     * tabel perjalanan_dinas_user
     *
     * @parameters
     * $year --- tahun saat ini
     * $id --- id perjalanan dinas
     *
     * */
    private function addSPPDNum($year, $id) {
        $perjalananUser = PerjalananDinasUser::where('perjalanan_dinas_id', $id)->get();

        $count = 1;

        foreach ($perjalananUser as $sppd) {
            $sppdCount = $this->writeSPPDNum($year) + $count;
            $sppdNum = $sppdCount."/SPD/".$year;
            PerjalananDinasUser::where('perjalanan_dinas_id', $id)
                ->where('user_id', $sppd->user_id)
                ->update(['no_sppd' => $sppdNum]);
        }
    }

    /*
     *
     * Fungsi ini akan mentotal jumlah seluruh sppd
     * sudah disetujui oleh kepala kantor
     * dan membuat nomor sppd berdasarkan jumlah tersbut
     * setiap pengecekan dan input akan dilakukan berdasarkan
     * data yang ada pada database
     *
     * */
    private function writeSPPDNum($year) {
        /*$countPerjalanan = DB::table('perjalanan_dinas_user')
            ->join('perjalanan_dinas', 'perjalanan_dinas_user.perjalanan_dinas_id', '=', 'perjalanan_dinas.id')
            ->whereNotNull('perjalanan_dinas_user.no_sppd')
            ->where('perjalanan_dinas.status','=', config('central.status.8'))
            ->orWhere('perjalanan_dinas.status','=', config('central.status.9'))
            ->orWhere('perjalanan_dinas.status','=', config('central.status.0'))
            ->whereYear('perjalanan_dinas.updated_at', $year)
            ->count();*/


        $countPerjalanan = PerjalananDinasUser::where('no_sppd', '!=', null)
            ->whereHas('perjalanan', function (Builder $query) use ($year) {
                $query->whereYear('updated_at', $year);
            })->count();


        return ($countPerjalanan);
    }

    private function writeSTugasNum($monthRome, $year) {
        $countSurat = PerjalananDinas::whereYear('tanggal_berangkat', $year)
            ->where('status', '!=',config('central.status.02'))
            ->where('status', '!=',config('central.status.01'))
            ->where('status', '!=',config('central.status.1'))
            ->where('status', '!=',config('central.status.2'))
            ->count();
        return ($countSurat + 1)."/ST-13.01/".$monthRome."/".$year;
    }
}
