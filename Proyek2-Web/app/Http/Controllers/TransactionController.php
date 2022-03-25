<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = false;
        $order = Order::select("*")
        ->where('status', '=', 'UNPAID')
        ->where('user_id', '=', Auth::user()->id)
        ->orderBy('created_at','desc')
        ->get();
        if (request('paid')) {
            $order = Order::select("*")
            ->where('status', '=', 'PAID')
            ->where('user_id', '=', Auth::user()->id)
            ->where('resi', '=', null)
            ->orderBy('created_at','desc')
            ->get();
        } else if (request('send')) {
            $order = Order::select("*")
                ->where('status', '=', 'PAID')
                ->where('user_id', '=', Auth::user()->id)
                ->where('resi', '!=', null)
                ->where('order_notes','=',null)
                ->orderBy('created_at','desc')
                ->get();
            $status = true;
        }else if (request('receive')) {
            $order = Order::select("*")
                ->where('status', '=', 'PAID')
                ->where('user_id', '=', Auth::user()->id)
                ->where('resi', '!=', null)
                ->where('order_notes','!=',null)
                ->orderBy('created_at','desc')
                ->get();
        }

        return view('user.transaction', compact('order', 'status'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $status = false;
        if ($request->status) {
            $status = true;
        }
        $data = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('orders', 'carts.order_id', '=', 'orders.id')
            ->where('carts.user_id', '=', Auth::user()->id == null ? '' : Auth::user()->id)
            ->where('carts.status', '=', 'process')
            ->where('carts.order_id', '=', $id)
            ->select(
                'carts.id as id',
                'carts.qty as qty',
                'products.id as product_id',
                'products.nama as nama',
                'products.featured_image as featured_image',
                'orders.total_produk as total_produk',
                'orders.total_ongkir as total_ongkir',
                'products.berat as berat',
                'products.harga as harga',
                'categories.name as category_name',
                'carts.status as status',
                'orders.status as os'
            )
            ->get();
        $tripay = new TripayController();
        $order = Order::find($id);
        $detail =  $tripay->detailTransaksi($order->reference);
        return view('layouts.total', compact('detail', 'data', 'order', 'status'));
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