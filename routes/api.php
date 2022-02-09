<?php

use Illuminate\Http\Request;
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

Route::get('/auth', [\App\Http\Controllers\AuthController::class, 'auth']);
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'findAll']);
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'findOne']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
