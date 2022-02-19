<?php

namespace App\Http\Controllers;

use App\Models\DetailPerjalananDinas;
use Illuminate\Http\Request;

class DetailPerjalananDinasController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }

    function create($id) {
        return view('admin.perjalanandinas.riwayat.create', compact('id'));
    }

    function store(Request $request, $id)
    {
        $request->validate([
            'tempatKedatangan'=>'required',
            'tanggalKedatangan'=>'required',
            'tempatTujuan'=>'required',
            'tanggalBerangkat'=>'required|date|after_or_equal:tanggal_berangkat'
        ]);
//        dd($request->tempatBerangkat);

        $riwayat = new DetailPerjalananDinas;

        $riwayat->perjalanan_dinas_id = $id;
        $riwayat->tiba_di = $request->tempatTiba;
        $riwayat->tiba_di_tanggal = $request->tanggalTiba;
        $riwayat->berangkat_ke = $request->tempatTujuan;
        $riwayat->berangkat_tanggal = $request->tanggalBerangkat;

        $riwayat->save();

        return redirect()->route('perjalanan.show', $id)->with('success', 'Riwayat Perjalanan Berhasil disimpan');
    }

    function destroy($perjalananId, $riwayatId)
    {
        $riwayat = DetailPerjalananDinas::find($riwayatId);

        $riwayat->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus riwayat');
    }

    function edit($perjalananId, $riwayatId)
    {

    }
}
