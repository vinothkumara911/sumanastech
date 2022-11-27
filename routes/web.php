<?php

use Illuminate\Support\Facades\Route;

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
    return view('/auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware("auth")->group(function () {

    Route::get('product', [App\Http\Controllers\ProductController::class, 'index']);

    Route::get('product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name("product.show");

    Route::post('subscription', [App\Http\Controllers\ProductController::class, 'subscription'])->name("subscription.create");

});