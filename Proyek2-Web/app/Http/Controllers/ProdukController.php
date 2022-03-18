<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function all()
    {
        if(request('status')){
            if (request('status') == 1) {
                $status = false;
                $produk = Product::select("*")
                    ->orderBy("harga", "asc")
                    ->get();
                return view('layouts.product', compact('produk', 'status'));
            } else if(request('status') == 2){
                $status = false;
                $produk = Product::select("*")
                    ->orderBy("harga", "desc")
                    ->get();
                return view('layouts.product', compact('produk', 'status'));
            }  
        }else if (request('search')) {
            $status = false;
            $produk = Product::where('nama', 'LIKE', '%' . request('search') . '%')->get();
            return view('layouts.product', compact('produk', 'status'));
        }
        $status = false;
        return view('layouts.product', [
            'produk' => Product::all(),
            'status' => $status
        ]);
    }

    public function detail(Product $product)
    {
        return view('layouts.details', ['produk' => $product]);
    }
    public function gelas()
    {
        if (request('status') == 1) {
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 1)
                ->orderBy("harga", "asc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        } else if(request('status') == 2){
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 1)
                ->orderBy("harga", "desc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        }
        $status = true;
        $produk = Product::where('category_id', 1)->get();
        return view('layouts.product', compact('produk', 'status'));
    }
    public function vas()
    {
        if (request('status') == 1) {
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 4)
                ->orderBy("harga", "asc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        } else if(request('status') == 2){
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 4)
                ->orderBy("harga", "desc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        }
        $status = true;
        $produk = Product::where('category_id', 4)->get();
        return view('layouts.product', compact('produk', 'status'));
    }
    public function guci()
    {
        if (request('status') == 1) {
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 2)
                ->orderBy("harga", "asc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        } else if(request('status') == 2){
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 2)
                ->orderBy("harga", "desc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        }
        $status = true;
        $produk = Product::where('category_id', 2)->get();
        return view('layouts.product', compact('produk', 'status'));
    }
    public function aksesoris()
    {
        if (request('status') == 1) {
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 3)
                ->orderBy("harga", "asc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        } else if(request('status') == 2){
            $status = true;
            $produk = Product::select("*")
                ->where('category_id', '=', 3)
                ->orderBy("harga", "desc")
                ->get();
            return view('layouts.product', compact('produk', 'status'));
        }
        $status = true;
        $produk = Product::where('category_id', 3)->get();
        return view('layouts.product', compact('produk', 'status'));
    }
    
    public function murah()
    {
        if (request('status')) {
            $status = true;
            return redirect()->route('all', compact('status'));
        }
        $status = true;
        if (request('cat_id') == 1) {
            return redirect()->route('gelas', compact('status'));
            //return view('layouts.product',compact('produk','status'));
        } elseif (request('cat_id') == 2) {
            return redirect()->route('guci', compact('status'));
        } elseif (request('cat_id') == 3) {
            return redirect()->route('aksesoris', compact('status'));
        } elseif (request('cat_id') == 4) {
            return redirect()->route('vas', compact('status'));
        }
    }
    public function mahal()
    {
        if (request('status')) {
            $status = 2;
            return redirect()->route('all', compact('status'));
        }
        $status = true;
        if (request('cat_id') == 1) {
            $status = 2;
            return redirect()->route('gelas', compact('status'));
        } elseif (request('cat_id') == 2) {
            $status = 2;
            return redirect()->route('guci', compact('status'));
        } elseif (request('cat_id') == 3) {
            $status = 2;
            return redirect()->route('aksesoris', compact('status'));
        } elseif (request('cat_id') == 4) {
            $status = 2;
            return redirect()->route('vas', compact('status'));
        }
    }
}