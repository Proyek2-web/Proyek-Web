<?php

use App\Http\Controllers\AddressController;
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
Route::get('/',function(){
    return view('layouts.home');
})->name('login');
Route::post('/register', [LoginController::class, 'registration']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/callback', [CallbackController::class, 'handle']);

//--------------------------------------------HALAMAN PELANGGAN--------------------------------------------
Route::middleware(['auth', 'cekroles:user,admin'])->group(function () {
    Route::post('/ongkir', [CheckOngkirController::class, 'check_ongkir']);
    Route::get('/cities/{province_id}', [CheckOngkirController::class, 'getCities']);
    Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact.send');
    Route::resource('/cart', CartController::class);
    Route::resource('/checkout', CheckoutController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/alamat', AddressController::class);
    // Route::get('alamat', function () {
    //     return view('layouts.address');
    // });
});

Route::group(['namespace' => 'Pelanggan'],function () {
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
    Route::get('about', function () {
        return view('layouts.about');
    });
    
});
//--------------------------------------------HALAMAN ADMIN--------------------------------------------
Route::middleware(['auth', 'cekroles:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('section.dashboard');
    });
    Route::get('/product/delete/{id}',[ProductController::class, 'destroy']);
    Route::get('/category/delete/{id}',[CategoryController::class, 'destroy']);
    Route::get('/user/delete/{id}',[DashboardController::class, 'destroy']);
    Route::get('/category/checkSlug', [CategoryController::class, 'checkSlug']);
    Route::get('/product/checkSlug', [ProductController::class, 'checkSlug']);
    Route::get('/active', [ProductController::class, 'active']);
    Route::put('/activated/{id}', [ProductController::class, 'activated']);
    Route::put('/deactivated/{id}', [ProductController::class, 'deactivated']);
    Route::get('/deactive', [ProductController::class, 'deactive']);
    Route::resource('/user', DashboardController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/order', OrderController::class);
    Route::resource('/unpaid', OrderController::class);
    Route::resource('/paid', OrderController::class);
    Route::resource('/send', OrderController::class);
    Route::resource('/receive', OrderController::class);
    Route::resource('/report', ReportController::class);
    Route::get('/report-order/export_excel', [ReportController::class, 'export_excel'])->name('export-order.index');
    Route::get('/report-parameter/export_excel_parameter', [ReportController::class, 'export_excel_parameter'])->name('export-order-parameter');
    // Route::resource('/resi', OrderCustController::class);
    // Route::get('/search', [SearchController::class, 'index']);
    // Route::get('/filter', [ReportController::class, 'filter']);
    Route::get('/nota/cetak/{id}', [OrderCustController::class, 'cetakNota'])->name('nota.cetak');
});