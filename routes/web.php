<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['verify.shopify'])->name('home');

Route::get('/shop', [\App\Http\Controllers\ShopController ::class,'getDetails'])->name('shop.index')->middleware(['verify.shopify']);

Route::get('/collections', [\App\Http\Controllers\ShopController::class, 'collectionIndex'])
    ->middleware(['verify.shopify'])
    ->name('collection.index');

Route::post('/collections', [\App\Http\Controllers\ShopController::class, 'collectionStore'])
    ->middleware(['verify.shopify'])
    ->name('collection.save');



Route::get('/products/{collectionId}', [\App\Http\Controllers\ShopController::class, 'products'])
    ->middleware(['verify.shopify'])
    ->name('collection.products');
Route::post('/products/{collectionId}', [\App\Http\Controllers\ShopController::class, 'products'])
    ->middleware(['verify.shopify'])
    ->name('collection.products.save');



