<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TestController;
use \App\Http\Controllers\FirestoreController;
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

Route::get('/products', [FirestoreController::class, 'viewAllProducts']);
Route::get('/products/{proID}', [FirestoreController::class, 'viewProduct']);
Route::post('/products/create', [FirestoreController::class, 'createProduct']);
Route::delete('/products/{proID}', [FirestoreController::class, 'deleteProduct']);
Route::put('/products/{proID}', [FirestoreController::class, 'updateProduct']);

// Route::post('/', [TestController::class, 'create']);
Route::get('/', [TestController::class, 'index']);
Route::put('/', [TestController::class, 'edit']);
Route::delete('/', [TestController::class, 'delete']);