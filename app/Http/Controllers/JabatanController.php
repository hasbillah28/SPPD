<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
            $jabatans = Jabatan::orderBy('nama_jabatan')->get();


        return view('admin.jabatan.index', compact('jabatans'));
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
        $id=substr(md5(mt_rand()), 0, 6);
        $request->validate([
            'nama_jabatan'=>'required'
        ]);

        $jabatan = new Jabatan([
            'id'=>'JBT_'.$id,
            'nama_jabatan'=>$request->get('nama_jabatan')
        ]);
        $jabatan->save();

        return redirect('/admin/jabatan')->with('success', 'Data Jabatan Berhasil ditambahkan');
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
    /*public function edit($id)
    {
        $jabatan = Jabatan::find($id);
        return response()->json($jabatan);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_jabatan'=>'required'
        ]);

        $jabatan = Jabatan::find($request->idJabatan);


        $jabatan->nama_jabatan = $request->nama_jabatan;

        $jabatan->save();

        return back()->with('success', 'Berhasil update data                 jabatan');
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
            $jabatan = Jabatan::find($id);
            $jabatan->delete();

            return redirect('/admin/jabatan')->with('success', 'Jabatan Berhasil dihapus');
        }
       catch (QueryException $exception) {
           return redirect('/admin/jabatan')->with('error', 'Data tidak bisa dihapuskan');
       }
    }
}
