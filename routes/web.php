<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\IndexController;
use App\Http\Controllers\CatalogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\IndexController@show');
Route::get('/catalog', 'App\Http\Controllers\CatalogController@show');
Route::get('/product_card/{id}', 'App\Http\Controllers\ProductCardController@show');
Route::patch('/add_to_cart', 'App\Http\Controllers\CartController@add_to_cart');
Route::get('/check_cart', 'App\Http\Controllers\CartController@check_cart');
Route::get('/cart', 'App\Http\Controllers\CartController@show');
Route::patch('/save_cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/order/{id}', 'App\Http\Controllers\OrderController@show');
Route::post('/order/{id}', 'App\Http\Controllers\OrderController@save');
Route::get('/order', 'App\Http\Controllers\OrderController@test');
Route::post('/order', 'App\Http\Controllers\OrderController@test_save');
