<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\JenisAngkutan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GolonganController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $golongans = Golongan::OrderBy('nama_golongan')->get();

        return view('admin.golongan.index', compact('golongans'));
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
            'nama_golongan'=>'required'
        ]);

        $golongan = new Golongan([
            'id'=>'GL_'.$id,
            'nama_golongan'=>$request->get('nama_golongan')
        ]);
        $golongan->save();

        return redirect('/admin/golongan')->with('success', 'Golongan Berhasil ditambahkan');
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
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_golongan'=>'required'
        ]);

        $golongan = Golongan::find($request->id);
        $golongan->nama_golongan = $request->nama_golongan;

        $golongan->save();

        return back()->with('success', 'Berhasil mengubah golongan');
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
            $golongan = Golongan::find($id);
            $golongan->delete();

            return redirect()->route('golongan.index')->with('success','Data berhasil terhapus');
        } catch (QueryException $exception) {
            return redirect()->route('golongan.index')->with('error', 'Data tidak bisa dihapuskan');

        }
    }
}
