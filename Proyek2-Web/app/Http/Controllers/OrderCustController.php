<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderCustController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $order = Order::all();
        // foreach ($order as $key ) {
        //     $id++;
        //     $key->total = ($key->qty * $key->product->harga)+$key->delivery->harga;
        //     $key->save();
        // }
        // // dd($id);
        $orders = Order::find($id);
        return view('layouts.total', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        $save = new Order;
        $tripay = new TripayController();
        $product = Product::find($request->product_id);
        $method = $request->method;

        $save->nama = $request->nama;
        $save->phone_number = $request->phone_number;
        $save->custom = $request->custom;
        $save->email = $request->email;
        $save->product_id = $request->product_id;
        $save->qty = $request->qty;
        $save->delivery_id = $request->delivery_id;
        $save->category_id = $request->category_id;
        // dd($request->all());
        $save->save();
        $tripay->requestTransaction($method, $product);
        return redirect(route('custorder.index'));
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
