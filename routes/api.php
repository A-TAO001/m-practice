<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/purchase/{id}', 'ProductController@purchase')->name('purchase');
// Route::post('purchase/{id}', [ProductController::class,'purchase'])->name('purchase');
Route::post('purchase/{id}', [SaleController::class,'purchase'])->name('purchase');


