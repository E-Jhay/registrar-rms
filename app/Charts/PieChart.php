<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\Status;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PieChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        // get collection of orders with count
        $query = Order::select([
            'status_id',
            DB::raw('COUNT(id) as count')
        ])
        ->groupBy('status_id')
        ->orderBy('status_id')
        ->get()
        ->pluck('count', 'status_id');

        // get status name and id
        $statuses = Status::select('name', 'id')
        ->pluck('name', 'id');
        $labels = [];
        $datasets = $query->toArray();
        // set value to the labels array
        $query->each(function ($item, $key) use (&$labels, &$statuses){
            $labels[$key] = $statuses[$key];
        });

        // dd($statuses, $query, $labels, $datasets);
        return Chartisan::build()
            ->labels(array_values($labels))
            ->dataset('Status Report', array_values($datasets));
    }
}