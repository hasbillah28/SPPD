<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\JenisAngkutan;
use App\Models\PerjalananDinas;
use App\Models\PerjalananDinasUser;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerjalananDinasController extends Controller
{
    const MONTH_NAME = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustuts', 'September', 'Oktober', 'November', 'Desember'
    ];

    const MONTH_ROME = [
        'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X','XI', 'XII'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $perjalanans = PerjalananDinas::where('status', '!=', config('central.status.01'))
                ->orderByDesc('created_at')
                ->paginate(8);

            return view('admin.perjalanandinas.index', compact('perjalanans'));

        } else if($user->hasRole('pegawai')) {
            /*$perjalanans = DB::table('perjalanan_dinas')
                ->rightJoin('perjalanan_dinas_user', function ($join) use ($user) {
                    $join->on('perjalanan_dinas.id','=', 'perjalanan_dinas_user.perjalanan_dinas_id')
                        ->where('perjalanan_dinas_user.user_id', '=', $user->id);
                })
                ->whereNotNull('perjalanan_dinas.no_surat_tugas')
                ->orWhere('perjalanan_dinas.user_id', '=', $user->id)
                ->select(DB::raw('perjalanan_dinas.*, count(perjalanan_dinas_user.user_id) as anggotas'))
                ->groupBy('perjalanan_dinas.id')
                ->paginate(5);*/

            $perjalanans = PerjalananDinas::whereRelation('anggotas', 'user_id', $user->id)
                ->orWhere('user_id', $user->id)
                ->orderByDesc('created_at')
                ->paginate(5);
//            dd($perjalanans);

            return view('pegawai.perjalanan.index', compact('perjalanans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $angkutans = JenisAngkutan::all();
        $users = User::all();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $route = 'admin.perjalanandinas.create';
        }
        else {
            $route = 'pegawai.perjalanan.create';
        }

        return view($route, compact('angkutans', 'users'));
    }

    public function storeAsAdmin(Request $request) {
        $request->validate([
            'angkutan' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'tanggal_berangkat' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'tempat_berangkat' => 'required',
            'tempat_tujuan' => 'required'
        ]);


        $user = Auth::user();

        $dateNow = date("YmdHis");
        $idPerjalananDinas = "PD-".$dateNow;

        $month = date('m');
        $monthRome = self::MONTH_ROME[$month - 1];
        $year = date('Y');

        $noSuratTugas = $this->writeSTugasNum($monthRome, $year);

        $perjalanan = new PerjalananDinas([
            'id'=>$idPerjalananDinas,
            'jenis_angkutan_id'=>$request->get('angkutan'),
            'deskripsi'=>$request->get('deskripsi'),
            'tempat'=>$request->get('tempat'),
            'tanggal_berangkat'=>$request->get('tanggal_berangkat'),
            'tanggal_kembali'=>$request->get('tanggal_kembali'),
            'tempat_berangkat'=>$request->get('tempat_berangkat'),
            'tempat_tujuan'=>$request->get('tempat_tujuan'),
            'no_surat_tugas'=>$noSuratTugas,
            'user_id'=>$user->id,
            'status'=>config('central.status.3')
        ]);

        $perjalanan->save();

        return redirect()->route('perjalanan.index')->with('success', 'Berhasil Menambahkan Perjalanan, silakan tambah anggota pada halaman detail');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'angkutan' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'tanggal_berangkat' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'tempat_berangkat' => 'required',
            'tempat_tujuan' => 'required'
        ]);

        $user = Auth::user();
        $dateNow = date("YmdHis");
        $idPerjalananDinas = "PD-" . $dateNow;

        $perjalanan = new PerjalananDinas([
            'id' => $idPerjalananDinas,
            'jenis_angkutan_id' => $request->get('angkutan'),
            'deskripsi' => $request->get('deskripsi'),
            'tempat' => $request->get('tempat'),
            'tanggal_berangkat' => $request->get('tanggal_berangkat'),
            'tanggal_kembali' => $request->get('tanggal_kembali'),
            'tempat_berangkat' => $request->get('tempat_berangkat'),
            'tempat_tujuan' => $request->get('tempat_tujuan'),
            'user_id' => $user->id,
            'status' => config('central.status.01')
        ]);

        $perjalanan->save();

        $perjalananUser = new PerjalananDinasUser([
            'perjalanan_dinas_id' => $idPerjalananDinas,
            'user_id' => Auth::user()->id
        ]);

        $perjalananUser->save();

        return redirect()->route('pegawai.perjalanan')->with('success', 'Berhasil Menambahkan Perjalanan, silakan tambah anggota pada halaman detail');
    }

    public function tampil($id)
    {
        $perjalanan = PerjalananDinas::find($id);
        $users = User::all();

        $user = Auth::user();

        if ($user->hasRole('kaur')) {
            $view = 'kaur.perjalanan.detail';
        } else if ($user->hasRole('kasubag')) {
            $view = 'kasubag.perjalanan.detail';
        } else if ($user->hasRole('kakan')) {
            $view = 'kakan.perjalanan.detail';
        }

        return view($view, compact('perjalanan', 'users', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $perjalanan = PerjalananDinas::find($id);
        $users = User::orderBY('name')->get();

        $user = Auth::user();
        if ($user->hasRole('admin')) {
        return view('admin.perjalanandinas.detail', compact('perjalanan', 'users', 'user'));
    }

        return view('pegawai.perjalanan.detail', compact('perjalanan', 'users', 'user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $perjalanan = PerjalananDinas::find($id);
        $angkutans = JenisAngkutan::all();

        $user = Auth::user();
        if ($user->hasRole('admin')){

            return view('admin.perjalanandinas.edit', compact('perjalanan', 'angkutans'));
        }
        return view('pegawai.perjalanan.edit', compact('perjalanan', 'angkutans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){
        $request->validate([
            'angkutan' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'tempat_berangkat' => 'required',
            'tempat_tujuan' => 'required'
        ]);
        $perjalanan = PerjalananDinas::find($id);

        $perjalanan->jenis_angkutan_id = $request->get('angkutan');
        $perjalanan->deskripsi = $request->get('deskripsi');
        $perjalanan->tempat = $request->get('tempat');
        $perjalanan->tanggal_berangkat = $request->get('tanggal_berangkat');
        $perjalanan->tanggal_kembali = $request->get('tanggal_kembali');
        $perjalanan->tempat_berangkat = $request->get('tempat_berangkat');
        $perjalanan->tempat_tujuan = $request->get('tempat_tujuan');

        $perjalanan->save();


        return redirect()->route('perjalanan.show', $id)->with('success', 'Berhasil update detail perjalanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $perjalanan = PerjalananDinas::find($id);
        $status = $perjalanan->status;
        if ($status != config('central.status.01') && $status != config('central.status.02')) {
            return redirect()->back()->with('error', 'Perjalanan dinas '.$id.' sudah tidak bisa dihapus');
        }

        $perjalanan->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus perjalanan '.$id);
    }

    /**
     * Print Surat Tugas
     *
     * @param  int  $id
     */
    public function print($id)
    {
        $month = date('m');
        $monthName = self::MONTH_NAME[$month - 1];

        $perjalanan = PerjalananDinas::find($id);

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

        $kakan = User::role('kakan')->get();
        return view('admin.perjalanandinas.print', compact('perjalanan', 'monthName', 'kakan', 'dayInterval', 'daySurat', 'monthSurat', 'yearSurat','daySuratsampai','monthSuratsampai','yearSuratsampai'));
    }

    private function writeSTugasNum($monthRome, $year) {
        $countSurat = PerjalananDinas::whereYear('tanggal_berangkat', $year)
            ->where('status', '!=', config('central.status.01'))
            ->where('status', '!=', config('central.status.02'))
            ->where('status', '!=', config('central.status.1'))
            ->where('status', '!=', config('central.status.2'))
            ->count();
        return ($countSurat + 1)."/ST-13.01/".$monthRome."/".$year;
    }


}
