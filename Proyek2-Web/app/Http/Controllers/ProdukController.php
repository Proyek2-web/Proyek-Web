<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Delivery;
use App\Models\Product;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function all()
    {
        return view('layouts.product', [
            'produk' => Product::all()
        ]);
    }
    
    public function detail(Product $product)
    {
        return view('layouts.details', ['produk' => $product]);
    }
    public function gelas()
    {
        $product = Product::where('category_id', 1);
        return view('layouts.product', [
            'produk' => $product->get()
        ]);
    }
    public function vas()
    {
        $product = Product::where('category_id', 4);

        return view('layouts.product', [
            'produk' => $product->get()
        ]);
    }
    public function guci()
    {
        $product = Product::where('category_id', 2);
        return view('layouts.product', [
            'produk' => $product->get()
        ]);
    }
    public function aksesoris()
    {
        $product = Product::where('category_id', 3);
        return view('layouts.product', [
            'produk' => $product->get()
        ]);
    }

    public function find(Request $request)
    {
        $produk = Product::all();
        if($request->search){
            $produk = Product::where('nama', 'LIKE', '%'.$request->search.'%')->get();
        }
        return view('layouts.product',compact('produk'));
        
    }
    public function murah(){
        $produk = Product::select("*")
        ->orderBy("nama","asc")
        ->get();
        return view('layouts.product',compact('produk'));
    }
    public function mahal(){
        $produk = Product::select("*")
        ->orderBy("nama","desc")
        ->get();
        return view('layouts.product',compact('produk'));
    }
}