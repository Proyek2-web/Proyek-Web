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
        $simpan= Order::find($s->id);
        $tripay = new TripayController();
        $method = $request->method;

      
        $transaction = $tripay->requestTransaction($method, $simpan);
    
        $json = json_encode($transaction);
        $dt= json_decode($json,true);
        $save = Order::find($s->id);
        $save->nama             = $request->nama;
        $save->phone_number     = $request->phone_number;
        $save->custom           = $request->custom;
        $save->kota             = $request->kota;
        $save->alamat           = $request->alamat;
        $save->state_id         = $request->state_id;
        $save->email            = $request->email;
        $save->product_id       = $request->product_id;
        $save->quantity         = $request->quantity;
        $save->delivery_id      = $request->delivery_id;
        $save->category_id      = $request->category_id;
        $save->merchant_ref     = $dt['data']['merchant_ref'];
        $save->reference        = $dt['data']['reference'];
        $save->amount           = $dt['data']['amount'];
        $save->save();
        $detail =  $tripay->detailTransaksi($save->reference);
        return view('layouts.total', compact('detail'));

        // return redirect()->route('transaksi.show', [
        //     'reference' => $save->reference,
        // ]);


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

    // public function show($reference)
    // {

    //     $tripay = new TripayController();
    //     $detail =  $tripay->detailTransaksi($reference);
    //     return view('layouts.total', compact('detail'));
    // }

    public function edit($id)
    {
        //
    }
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