<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratTugasController extends Controller
{
    public function getAsAdmin() {
        $suratTugas = PerjalananDinas::where('no_surat_tugas', '!=', null)
            ->orderByDesc('no_surat_tugas')
            ->paginate(8);

        return view('admin.surattugas.index', compact('suratTugas'));
    }

    public function getAsUser() {
        $user = Auth::user();

        /*$suratTugas = DB::table('perjalanan_dinas')
            ->rightJoin('perjalanan_dinas_user', function ($join) use ($user) {
                $join->on('perjalanan_dinas.id','=', 'perjalanan_dinas_user.perjalanan_dinas_id')
                    ->where('perjalanan_dinas_user.user_id', '=', $user->id);
            })
            ->select(DB::raw('perjalanan_dinas.*, count(perjalanan_dinas_user.user_id) as anggotas'))
            ->whereNotNull('perjalanan_dinas.no_surat_tugas')
            ->orWhere('perjalanan_dinas.user_id', '=', $user->id)
            ->groupBy('perjalanan_dinas.id')
            ->paginate(5);*/

        $suratTugas = PerjalananDinas::whereRelation('anggotas', 'user_id', $user->id)
            ->whereNotNull('no_surat_tugas')
            ->orWhere('user_id', $user->id)
            ->orderByDesc('tanggal_berangkat')
            ->paginate(5);


        return view('pegawai.surattugas.index', compact('suratTugas'));
    }
}
