<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinasUser;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index($id) {
        $anggotas = PerjalananDinasUser::where('user_id' ,$id)->whereRelation('perjalanan', 'status', config('central.status.0'))->paginate(8);
        return view('admin.users.riwayat.index', compact('anggotas'));
    }
}
