<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

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
        $allOrders = Order::get()->count();
        $pendingOrders = Order::where('status_id', 1)->count();
        $claimableOrders = Order::where('status_id', 2)->count();
        $accounts = User::get()->count();
        return view('dashboard', compact('allOrders', 'pendingOrders', 'claimableOrders', 'accounts'));
    }
}
