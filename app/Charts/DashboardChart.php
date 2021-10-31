<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $orders = Order::select([
            DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(id) as ordersCount')
        ])
        ->whereYear('created_at', now()->year)
        ->orderBy('month')
        ->groupBy('month')
        ->get();
        // $orders = Order::select([
        //     DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
        //     DB::raw('COUNT(id) as ordersCount')
        // ])
        // ->groupBy('month')
        // ->orderBy('month')
        // ->get();

        $report = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0];
        array_fill_keys($report, '0');
        $orders->each(function($item) use (&$report){
            $report[$item->month] = $item->ordersCount;
        });

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        return Chartisan::build()
            ->labels($months)
            ->dataset('Requests this '. date('Y'), array_values($report));
    }
}