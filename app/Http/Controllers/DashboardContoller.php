<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardContoller extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->subDays(30); // 30 days ago
        $endDate = Carbon::now();

        $profits = Sale::selectRaw('DATE(tanggal) as date, SUM(total_bayar) as total_profit')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $dates = $profits->pluck('date');
        $totalProfits = $profits->pluck('total_profit');


        return view('dashboard.index',[
            'dates' => $dates,
            'totalProfits' => $totalProfits
        ]);
    }
}
