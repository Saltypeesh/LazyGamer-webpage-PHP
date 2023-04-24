<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\FeedbacksController;
use App\Http\Controllers\Api\ListingsController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\OrdersController;
use App\Models\Order;

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

// Public routes
Route::post('/users/login', [AuthController::class, 'userLogin']);
Route::post('/users/register', [AuthController::class, 'userRegister']);

Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::post('/admin/register', [AuthController::class, 'adminRegister']);


Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/listings/{listing}', [ProductsController::class, 'show']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/listings', ListingsController::class);
    Route::get('/users/orders', [OrdersController::class, 'index']);
    Route::resource('/users/carts', CartsController::class);
    Route::resource('/users/feedbacks', FeedbacksController::class);
    Route::delete('/users/delete/{user}', [AuthController::class, 'destroy']);


    Route::post('/logout', [AuthController::class, 'logout']);
});
