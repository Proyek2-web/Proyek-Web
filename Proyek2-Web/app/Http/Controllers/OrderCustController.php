<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderCustController extends Controller
{

    public function index()
    {
        // $order = Order::all();
        // foreach ($order as $key ) {
        //     $id++;
        //     $key->total = ($key->qty * $key->product->harga)+$key->delivery->harga;
        //     $key->save();
        // }
        // // // dd($id);
        // $orders = Order::find($id);
        // return view('layouts.total', compact('orders'));
    }
    public function store(Request $request)

    {
        // dd($request->all());
        $s=Order::create($request->all());

        // $transaction= Order::find($s->id);
        $save = new Order;
        $tripay = new TripayController();
        $method = $request->method;

      
        $transaction = $tripay->requestTransaction($method, $orders);
        // dd( $transaction);
        $save->nama             = $request->nama;
        $save->phone_number     = $request->phone_number;
        $save->custom           = $request->custom;
        $save->email            = $request->email;
        $save->product_id       = $request->product_id;
        $save->quantity         = $request->quantity;
        $save->delivery_id      = $request->delivery_id;
        $save->category_id      = $request->category_id;
        $save->merchant_ref     = $merchantRef;
        $save->reference        = "HALO";
        $save->amount           = $amount;
        $save->save();
        $orders = Order::find($s->id);
        
        // $detail =  $tripay->detailTransaksi($save->reference);
        // return view('layouts.total', compact('detail'));

        return redirect()->route('transaksi.show', [
            'reference' => $save->reference,
        ]);


        // Order::create([
        //     'nama'      => $request->nama,
        //     'phone_number' => $request->phone_number,
        //     'custom' => $request->custom,
        //     'email' => $request->email,
        //     'product_id' => $request->id,
        //     'category_id ' => $request->category_id,
        //     'quantity' => $request->quantity,
        //     'delivery_id' => $request->delivery_id,
        //     'reference' => $transaction->reference,
        //     'merchant_ref' => $transaction->merchant_ref,
        //     'amount' => $transaction->amount,
        //     'status' => $transaction->status,
        // ]);
        //     return redirect()->route('transaksi.show', [
        //     'reference' => $transaction->reference,
        // ]);

    }

    public function show($reference)
    {

        $tripay = new TripayController();
        $detail =  $tripay->detailTransaksi($reference);
        return view('layouts.total', compact('detail'));
    }

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

    public function save(Request $request)
    {
    }
}
