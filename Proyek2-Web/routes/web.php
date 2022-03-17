<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderCustController;
use App\Http\Controllers\Payment\CallbackController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CheckoutController;

//--------------------------------------------HALAMAN AWAL-------------------------------------------------
Route::get('/', function () {
    return view('layouts.home');
});
Route::post('/register', [LoginController::class, 'registration']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//--------------------------------------------HALAMAN PELANGGAN--------------------------------------------
Route::get('/check', [LoginController::class, 'alert']);
Route::post('/ongkir', [CheckOngkirController::class, 'check_ongkir']);
Route::get('/cities/{province_id}', [CheckOngkirController::class,'getCities']);
Route::post('/contact', [ContactController::class, 'sendMail']);
Route::get('/contact', [ContactController::class, 'showContactForm']);
Route::get('/produk', [ProdukController::class, 'all'])->name('all');
Route::get('/cari', [ProdukController::class, 'find']);
Route::get('/gelas', [ProdukController::class, 'gelas'])->name('gelas');
Route::get('/produk/termurah', [ProdukController::class, 'murah']);
Route::get('/produk/termahal', [ProdukController::class, 'mahal']);
Route::get('/vas', [ProdukController::class, 'vas'])->name('vas');
Route::get('/guci', [ProdukController::class, 'guci'])->name('guci');
Route::get('/aksesoris', [ProdukController::class, 'aksesoris'])->name('aksesoris');
Route::get('/details/{product:slug}', [ProdukController::class, 'detail']);
Route::resource('/cart', CartController::class);
Route::resource('/checkout', CheckoutController::class);
Route::resource('/transaction', TransactionController::class);
Route::get('about', function () {
    return view('layouts.about');
});
Route::get('/detail', function () {
    return view('layouts.detail');
});
Route::get('/form-order', function () {
    return view('layouts.form-order');
});

Route::resource('/checkout-post',OrderCustController::class);
Route::post('/callback', [CallbackController::class, 'handle']);

//--------------------------------------------HALAMAN ADMIN--------------------------------------------
Route::middleware(['auth','cekroles:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('section.index');
    });
    Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);
    Route::get('/product/checkSlug', [ProductController::class, 'checkSlug']);
    Route::resource('/user', DashboardController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/order', OrderController::class);
    Route::resource('/report', ReportController::class);
    Route::resource('/resi', OrderCustController::class);
    Route::get('/search', [SearchController::class, 'index']);
    Route::get('/filter', [ReportController::class, 'filter']);
    Route::get('/nota/cetak/{id}', [OrderCustController::class, 'cetakNota'])->name('nota.cetak');
});