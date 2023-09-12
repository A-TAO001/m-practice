<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;

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

Route::group(['middleware' => 'auth'], function() {

Route::get('top', [TopController::class, 'index'])->name('top');
Route::get('/', [TopController::class, 'index'])->name('top');

Route::delete('top/{id}', [ProductController::class, 'delete'])->name('delete');
Route::post('top/search', [ProductController::class, 'search'])->name('search');
Route::post('top/price_search', [ProductController::class, 'pricesearch'])->name('price_search');
Route::post('top/stock_search', [ProductController::class, 'stocksearch'])->name('stock_search');


Route::get('entry', [ProductController::class, 'index'])->name('entry_view');
Route::post('entry', [ProductController::class, 'entry'])->name('product_entry');

Route::get('/product/{id}', [ProductController::class, 'deta'])->name('deta');
Route::get('/deta/{id}', [ProductController::class, 'update_view'])->name('update_view');

Route::put('/update/{id}', [ProductController::class, 'update_edit'])->name('update_edit');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});

Auth::routes();
