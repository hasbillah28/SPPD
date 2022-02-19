<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SPPDController extends Controller
{
    const MONTH_NAME = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    public function getAsAdmin() {
        $sppd = PerjalananDinasUser::whereNotNull('no_sppd')
            ->orderByDesc('id')
            ->paginate(8);

        return view('admin.sppd.index', compact('sppd'));
    }

    public function getAsUser() {
        $sppd = PerjalananDinasUser::where('no_sppd', '!=', null)
            ->where('user_id', Auth::user()->id)
            ->whereHas('perjalanan', function (Builder $query) {
                $query->where('status', config('central.status.9'))
                    ->orWhere('status', config('central.status.0'));
            })
            ->paginate(8);

        return view('admin.sppd.index', compact('sppd'));
    }

    public function getForRekap(Request $request) {

        $startMonth = $request->startDate;
        $endMonth = $request->endDate;

        $sppd = PerjalananDinasUser::whereNotNull('no_sppd')
            ->whereHas('perjalanan', function (Builder $query) use ($startMonth, $endMonth) {
                $query->whereBetween('tanggal_berangkat', [$startMonth, $endMonth])
                    ->orderByDesc('tanggal_berangkat');
            })
            ->get();

        return view('admin.sppd.rekap', compact('sppd'));
    }

    public function getRekap() {
        $sppd = PerjalananDinasUser::whereNotNull('no_sppd')
            ->paginate(8);

        $monthName = self::MONTH_NAME;

        return view('admin.sppd.rekap', compact('sppd', 'monthName'));
    }

    public function printRekap($startDate, $endDate) {
        /*$sppd = PerjalananDinasUser::whereNotNull('no_sppd')
            ->whereHas('perjalanan', function (Builder $query) use ($startMonth, $endMonth) {
                $query->whereBetween('tanggal_berangkat', [$startMonth, $endMonth]);
            })->get();

        return view('admin.sppd.print', compact('sppd'));*/
    }
}
