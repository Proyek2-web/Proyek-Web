<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\TripayController;
use App\Models\Cart;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $carts = Cart::all();
        $product = Product::all();
        $orders = Order::select("*")
        ->where('status', '=', 'UNPAID')
        ->orderBy('created_at','desc')
        ->get();
        $status = true;
        if (request('paid')) {
            $orders = Order::select("*")
            ->where('status', '=', 'PAID')
            ->where('resi', '=', null)
            ->orderBy('created_at','desc')
            ->get();
            $status = false;
        } else if (request('send')) {
            $orders = Order::select("*")
                ->where('status', '=', 'PAID')
                ->where('resi', '!=', null)
                ->where('order_notes','=',null)
                ->orderBy('created_at','desc')
                ->get();
        }else if (request('receive')) {
            $orders = Order::select("*")
                ->where('status', '=', 'PAID')
                ->where('resi', '!=', null)
                ->where('order_notes','!=',null)
                ->orderBy('created_at','desc')
                ->get();
        }
        return view('section.order',compact('orders','carts','product','status'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $o = Order::find($order->id);
        $o->resi = $request->resi;
        $o->save();
        Alert::success('Resi Berhasil Dimasukkan', '');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}