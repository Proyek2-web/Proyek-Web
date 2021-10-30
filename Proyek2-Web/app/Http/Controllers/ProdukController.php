<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Delivery;
use App\Models\Product;
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
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        return view('layouts.details', [
            'title' => 'Postingan Berdasarkan Author',
            'produk' => $product,
            'deliveries' => Delivery::all(),
            'channels' => $channels
        ]);
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
}