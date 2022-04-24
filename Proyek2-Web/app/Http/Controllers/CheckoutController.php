<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Payment\TripayController;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        $subtotal = $request->sub_total;
        $user_id = $request->user_id;
        $provinces = Province::pluck('name', 'province_id');
        $cart_count = Cart::all()->where('user_id', '=', $user_id == null ? '' : $user_id)->where('status', '=', "pending")->count();
        $data = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('carts.user_id', '=', $user_id == null ? '' : $user_id)
            ->where('carts.status', '=', 'pending')
            ->select('carts.id as id','carts.catatan as catatan', 'carts.qty as qty', 'products.id as product_id', 'products.nama as nama',
             'products.featured_image as featured_image','products.berat as berat', 'products.harga as harga', 'categories.name as category_name','carts.status as status')
            ->get();
            $total_berat = 0;
            $s= 0;
            foreach ($data as $d) {
                $s= $d->qty * $d->berat;
                $total_berat = $total_berat +  $s;
            }
        return view('layouts.form-order',compact('subtotal','provinces', 'cart_count','data','channels','total_berat'));
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
        $carbon = Carbon::now()->toDateString();
        $orders = new Order();
        $orders->nama = $request->nama;
        $orders->phone_number = $request->nomor_hp;
        $orders->custom = $request->custom;
        $orders->province_id = $request->province_destination;
        $orders->city_id = $request->city_destination;
        $orders->email = Auth::user()->email;
        $orders->alamat = $request->alamat;
        $orders->zip_code = $request->zip_code;
        $orders->amount = $request->total;
        $orders->user_id = Auth::user()->id;
        $orders->save();
        
        $simpan= Order::find($orders->id);
        $tripay = new TripayController();
        $method = $request->method;
        $total_ongkir = $request->total_ongkir;
        $sub_total = $request->sub_total;
        $transaction = $tripay->requestTransaction($method, $simpan,$total_ongkir,$sub_total);
        $json = json_encode($transaction);
        $dt= json_decode($json,true);
        $save = Order::find($orders->id);
        $save->nama = $request->nama;
        $save->phone_number = $request->nomor_hp;
        $save->custom = $request->custom;
        $save->province_id = $request->province_destination;
        $save->city_id = $request->city_destination;
        $save->email = Auth::user()->email;
        $save->alamat = $request->alamat;
        $save->total_produk = $sub_total;
        $save->total_ongkir = $total_ongkir;
        $save->zip_code = $request->zip_code;
        $save->amount = $request->total;
        $save->day = $request->total_hari;
        $save->delivery = $request->courier;
        $save->order_date = $carbon;
        $save->user_id = Auth::user()->id;
        $save->merchant_ref     = $dt['data']['merchant_ref'];
        $save->reference        = $dt['data']['reference'];
        $save->amount           = $dt['data']['amount'];
        if($save->save()){
            $cart = Cart::where('user_id', '=', Auth::user() == null ? '' : Auth::user()->id)
                ->where('status', '=', "pending")
                ->update(['status' =>  "process", 'order_id' =>  $save->id]);
        }
        Alert::success('Transaksi Berhasil', '');
        return redirect()->route('transaction.index');
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
        $order = Order::find($request->order_id);
        $order->order_notes = $request->received;
        $order->save();
        return redirect('/transaction');
        
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