<?php

namespace App\Http\Controllers;

use App\Models\JenisAngkutan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenisAngkutanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $angkutans = JenisAngkutan::all();

        return view('admin.jenisangkutan.index', compact('angkutans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $id=substr(md5(mt_rand()), 0, 7);
        $request->validate([
            'nama_angkutan'=>'required'
        ]);

        $angkutan = new JenisAngkutan([
            'id'=>'JA_'.$id,
            'nama_angkutan'=>$request->get('nama_angkutan')
        ]);
        $angkutan->save();

        return redirect('/admin/angkutan')->with('success', 'Jenis Angkutan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_angkutan'=>'required'
        ]);

        $angkutan = JenisAngkutan::find($request->id);

        $angkutan->nama_angkutan = $request->nama_angkutan;

        $angkutan->save();

        return back()->with('success', 'Berhasil mengubah jenis angkutan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $jabatan = JenisAngkutan::find($id);
            $jabatan->delete();

            return redirect()->route('angkutan.index')->with('success', 'Data Berhasil dihapus');
        } catch (QueryException $exception) {
            return redirect()->route('angkutan.index')->with('error', 'Data tidak bisa dihapuskan');

        }

    }
}
