<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderCustController;
use App\Http\Controllers\Payment\CallbackController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReportController;
use App\Models\Order;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



// Login Admin
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('auth');
Route::get('/product/checkSlug', [ProductController::class, 'checkSlug'])->middleware('auth');
// Halaman Dashboard Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('section.index');
    });
    Route::resource('/user', DashboardController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/order', OrderController::class);
    Route::resource('/report', ReportController::class);
});

// ROUTE WEB UTAMA
Route::get('/home', function () {
    return view('layouts.home');
});

Route::post('/contact', [ContactController::class, 'sendMail']);
Route::get('/contact', [ContactController::class, 'showContactForm']);

Route::get('/produk', [ProdukController::class, 'all']);
Route::get('/gelas', [ProdukController::class, 'gelas']);
Route::get('/vas', [ProdukController::class, 'vas']);
Route::get('/guci', [ProdukController::class, 'guci']);
Route::get('/aksesoris', [ProdukController::class, 'aksesoris']);
Route::get('/details/{product:slug}', [ProdukController::class, 'detail']);
Route::get('about', function () {
    return view('layouts.about');
});
Route::get('/detail', function () {
    return view('layouts.detail');
});
Route::post('/transaksi-post', [OrderCustController::class, 'store']);
Route::post('/callback', [CallbackController::class, 'handle']);
Route::get('/search', [SearchController::class, 'index']);

Route::get('/nota/cetak/{id}',[OrderCustController::class,'cetakNota'])->name('nota.cetak');