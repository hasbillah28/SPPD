<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PangkatController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pangkats = Pangkat::OrderBy('nama_pangkat')->get();

        return view('admin.pangkat.index', compact('pangkats'));
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
            'nama_pangkat'=>'required'
        ]);

        $pangkat = new Pangkat([
            'id'=>'PKT_'.$id,
            'nama_pangkat'=>$request->get('nama_pangkat')
        ]);
        $pangkat->save();

        return redirect('/admin/pangkat')->with('success', 'Jenis Pangkat Berhasil ditambahkan');
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
            'nama_pangkat'=>'required'
        ]);

        $golongan = Pangkat::find($request->id);
        $golongan->nama_pangkat = $request->nama_pangkat;

        $golongan->save();

        return back()->with('success', 'Berhasil mengubah pangkat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $pangkat = Pangkat::find($id);
            $pangkat->delete();

            return redirect()->route('pangkat.index')->with('success', 'Data Berhasil dihapuskan');;
         }
         catch (QueryException $exception) {
             return redirect()->route('pangkat.index')->with('error', 'Data tidak bisa dihapuskan');
         }
}
}
