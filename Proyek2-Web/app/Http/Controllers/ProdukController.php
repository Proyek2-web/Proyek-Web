<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Delivery;
use App\Models\Product;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function all()
    {
        $status = false;
        return view('layouts.product', [
            'produk' => Product::all(),
            'status'=> $status 
        ]);
    }
    
    public function detail(Product $product)
    {
        return view('layouts.details', ['produk' => $product]);
    }
    public function gelas()
    {
        $status =true;
        $produk = Product::where('category_id', 1)->get();
        return view('layouts.product',compact('produk','status'));
    }
    public function vas()
    {
        $status =true;
        $produk = Product::where('category_id', 4)->get();
        return view('layouts.product',compact('produk','status'));
    }
    public function guci()
    {
        $status =true;
        $produk = Product::where('category_id', 2)->get();
        return view('layouts.product',compact('produk','status'));
    }
    public function aksesoris()
    {
        $status =true;
        $produk = Product::where('category_id', 3)->get();
        return view('layouts.product',compact('produk','status'));
    }

    public function find(Request $request)
    {
        $produk = Product::all();
        $status = true;
        if($request->search){
            $produk = Product::where('nama', 'LIKE', '%'.$request->search.'%')->get();
        }
        return view('layouts.product',compact('produk','status'));
        
    }
    public function murah(){
        if(request('status')){
            $status = false;
            $produk = DB::table('products')
            ->orderBy('harga', 'asc')
            ->get();
            return view('layouts.product',compact('produk','status'));     
        }
        $status = true;
        $produk = DB::table('products')
        ->where('products.category_id', '=', request('cat_id'))
        ->orderBy('harga', 'asc')
        ->get();
        if(request('cat_id') == 1){
            return view('layouts.product',compact('produk','status'));
        }
        elseif(request('cat_id') == 2){
            return view('layouts.product',compact('produk','status'));
        }
        elseif(request('cat_id') == 3){
            return view('layouts.product',compact('produk','status'));
        }
        elseif(request('cat_id') == 4){
            return view('layouts.product',compact('produk','status'));
        }
        // return back()->with(compact('produk'));
    }
    public function mahal(){
        $status = true;
        $produk = DB::table('products')
        ->where('products.category_id', '=', request('cat_id'))
        ->orderBy('harga', 'desc')
        ->get();
        if(request('cat_id') == 1){
            return view('layouts.product',compact('produk','status'));
        }
        elseif(request('cat_id') == 2){
            return view('layouts.product',compact('produk','status'));
        }
        elseif(request('cat_id') == 3){
            return view('layouts.product',compact('produk','status'));
        }
        elseif(request('cat_id') == 4){
            return view('layouts.product',compact('produk','status'));
        }
    }
}