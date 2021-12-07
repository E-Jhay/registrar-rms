<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('index');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    // protected $rules = [
    //     'mobile'                        =>  ['required'],
    //     'or_no'                         =>  ['required'],
    //     'orderItems.*.name'             =>  ['required'],
    //     'orderItems.*.document_type_id' =>  ['required'],
    // ];

    public function index()
    {
        // $orders = Order::all();
        // $orders = Order::with('status', 'document_type')
        //             ->where('status_id', 1)
        //             ->orderBy('created_at', 'desc')
        //             ->get();
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }
}
