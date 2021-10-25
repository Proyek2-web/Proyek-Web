<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProdukController;
use App\Models\Product;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

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
    Route::resource('/user', DashboardController::class)->middleware('auth');
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
});

// ROUTE WEB UTAMA
Route::get('/contact', [ContactController::class, 'showContactForm']);
Route::post('/contact', [ContactController::class, 'sendMail']);


Route::get('/home', function () {
    return view('layouts.home');
});

Route::get('/produk', [ProdukController::class,'all']);
Route::get('/gelas', [ProdukController::class, 'gelas']);
Route::get('/vas', [ProdukController::class, 'vas']);
Route::get('/guci', [ProdukController::class, 'guci']);
Route::get('/details/{product:slug}',[ProdukController::class,'detail'] );
Route::get('about', function () {
    return view('layouts.about');
});
Route::get('/detail', function () {
    return view('layouts.detail');
});