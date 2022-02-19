<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinas;
use App\Models\PerjalananDinasUser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    function index()
    {
        $perjalanans = PerjalananDinas::where('status', '!=', '02')
            ->get();

        $countSelesai = 0;
        $countProses = 0;
        $countTerdaftar = 0;
        $countSedang = 0;
        $countAll = $perjalanans->count();

        foreach ($perjalanans as $perjalanan) {
            if ($perjalanan->status === config('central.status.0')) {
                $countSelesai++;
            } if ($perjalanan->status === config('central.status.9')) {
                $countSedang+=$perjalanan->anggotas->count();
            } if ($perjalanan->status !== config('central.status.01')){
                $countTerdaftar++;
            } if ($perjalanan->status === config('central.status.3') || $perjalanan->status === config('central.status.8'))  {
                $countProses++;
            }
        }
        return view('home', compact('countSelesai', 'countProses', 'countSedang', 'countAll','countTerdaftar'));
    }
}
