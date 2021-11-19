<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allOrders = Order::whereMonth('created_at', now()->month)->count();
        $pendingOrders = Order::where('status_id', 1)->count();
        $claimableOrders = Order::where('status_id', 2)->count();
        $accounts = User::get()->count();

        // $orders = Order::select([
        //         DB::raw("DATE_FORMAT(created_at, '%m') as month"),
        //         DB::raw('COUNT(id) as ordersCount')
        //     ])
        // ->whereYear('created_at', date('Y'))
        // ->orderBy('month')
        // ->groupBy('month')
        // ->get();
        // // $orders = Order::select([
        // //     DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
        // //     DB::raw('COUNT(id) as ordersCount')
        // // ])
        // // ->groupBy('month')
        // // ->orderBy('month')
        // // ->get();

        // $report = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0];
        // array_fill_keys($report, '0');
        // $orders->each(function($item) use (&$report){
        //     $report[$item->month] = $item->ordersCount;
        // });
        // return $report;
        return view('dashboard', compact('allOrders', 'pendingOrders', 'claimableOrders', 'accounts'));
    }
}
