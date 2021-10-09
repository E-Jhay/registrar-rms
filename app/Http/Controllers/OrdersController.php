<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = Order::all();
        $orders = Order::with('status', 'document_type')
                    ->where('status_id', 1)
                    ->get();
        return view('orders.index', compact('orders'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documents_array = array(1 => 'ROR', 2 => 'COR', 3 => 'COG', 4 => 'TOR', 5 => 'CAV', 6 => 'ATL', 7 => 'GWA');
        foreach($request->orderItems as $item){
            $count = Order::where('document_type_id', $item['document_type_id'])->count() + 1;
            $code = $documents_array[$item['document_type_id']];
            $ctr_no = $code ."-0". $count;
            $order = Order::create([
                'ctr_no'        =>  $ctr_no,
                'name'          =>  $item['name'],
                'mobile'        =>  $request->mobile,
                'document_type_id' =>  $item['document_type_id'],
                'status_id'        =>  1,
                'or_no'         =>  $request->or_no,
            ]);
            // echo $item['document_type_id'] ." ";
        }

        // $data = [];
        // foreach($request->orderItems as $item){
        //     ['name' => $item['name'], 'mobile' => $request->mobile],
        // }

        return 'Stored Successfully';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
