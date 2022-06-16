<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\HomeController;
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

Route::get('/', [LoginController::class, 'index']);
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('/products', [HomeController::class, 'products']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/product_detail/{Product:Product_Code}', [HomeController::class, 'product_detail']);
Route::get('/buy/{Product:id}', [HomeController::class, 'buy']);
