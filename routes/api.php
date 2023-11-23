<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('list-products', [ProductController::class, 'listProductsPagination']);
Route::post('search-client', [ProductController::class, 'searchClient']);
Route::post('save-sale', [ProductController::class, 'saveSale']);
Route::post('categories', [ProductController::class, 'categories']);
