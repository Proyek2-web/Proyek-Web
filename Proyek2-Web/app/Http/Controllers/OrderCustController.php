<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderCustController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 0;
        $order = Order::all();
        foreach ($order as $key ) {
            $id++;
            $key->total = ($key->qty * $key->product->harga)+$key->delivery->harga;
            $key->save();
        }
        // dd($id);
        
        return view('layouts.total',[
            'help' => Order::find($id)
        ]);
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
        $save->nama = $request->nama;
        $save->phone_number = $request->phone_number;
        $save->custom = $request->custom;
        $save->email = $request->email;
        $save->product_id = $request->product_id;
        $save->qty = $request->qty;
        $save->total = $request->total;
        $save->delivery_id = $request->delivery_id;
        $save->category_id = $request->category_id;
        $save->save();
        $help = $save->id;
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