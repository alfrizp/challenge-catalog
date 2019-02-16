<?php

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

Route::get('/', function () {
    $products = App\Models\Product::orderBy('updated_at', 'desc')->paginate(9);

    return view('home', compact('products'));
})->name('home');

Route::resource('products', 'ProductController')->only('index', 'store', 'update', 'destroy');
Route::resource('suppliers', 'SupplierController')->only('index', 'store', 'update', 'destroy');
