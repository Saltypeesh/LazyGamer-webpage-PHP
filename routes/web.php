<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ListingsController;
use App\Http\Controllers\FeedbacksController;

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

// **Public route**
Auth::routes();

Route::get('/feedbacks', [FeedbacksController::class, 'index']);
// Route::resource('/feedbacks', FeedbacksController::class);

Route::resource('/listings', ListingsController::class);
Route::get('/', [ListingsController::class, 'home'])->name('home');
Route::get('/denyAccess', [UserController::class, 'denyAccess'])->name('users.denyAccess');

Route::get('/terms_of_Use', [UserController::class, 'terms_of_Use'])->name('terms_of_Use');
Route::get('/privacy_Policy', [UserController::class, 'privacy_Policy'])->name('privacy_Policy');
Route::get('/faq', [UserController::class, 'faq'])->name('faq');

Route::middleware('guest')->group(function () {
    // Show Register/Create Form
    Route::get('/users/register', [UserController::class, 'create'])->name('users.register');
    // Show Login Form
    Route::get('/users/login-view', [UserController::class, 'login_view'])->name('login-view');
    // Create New User
    Route::post('/users/create', [UserController::class, 'store'])->name('users.create');
});

// **User route**
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::put('/users/{user}', [UserController::class, 'save'])->name('users.save');
    Route::put('/users/toAdmin/{user}', [UserController::class, 'toAdmin'])->name('users.toAdmin');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.deleteAcc');

    // Shopping Cart
    Route::get('/users/cart', [CartsController::class, 'index'])->name('users.cart');
    Route::post('users/listings', [CartsController::class, 'store'])->name('users.store');
    Route::post('users/listings/buynow', [CartsController::class, 'buyNow'])->name('users.buyNow');
    Route::put('users/listings/{listing}', [CartsController::class, 'update'])->name('users.update');
    Route::delete('users/listings/{listing}', [CartsController::class, 'destroy'])->name('users.delete');

    // User orders
    Route::get('/users/orders', [OrdersController::class, 'index']);
    Route::post('/users/orders', [OrdersController::class, 'store']);

    // User feedbacks
    Route::post('/feedbacks', [FeedbacksController::class, 'store']);
    Route::put('/feedbacks/{user}', [FeedbacksController::class, 'update']);
    Route::delete('/feedbacks/{user}', [FeedbacksController::class, 'destroy']);
});
// --------------------------------------------------------------------------

// **Admin Route**
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    // Listings CRUD
    Route::get('/admin', [ListingsController::class, 'home'])->name('admin.home');
    Route::get('/admin/listings/create', [ListingsController::class, 'create'])->name('admin.create');
    Route::post('/admin/listings', [ListingsController::class, 'store'])->name('admin.store');
    Route::get('/admin/listings/{listing}/edit', [ListingsController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/listings/{listing}', [ListingsController::class, 'update'])->name('admin.update');
    Route::delete('/admin/listings/{listing}', [ListingsController::class, 'destroy'])->name('admin.delete');

    // Manage Listings
    Route::get('/admin/manage', [UserController::class, 'manage'])->name('admin.manage');
});

// **User Route**
Route::middleware(['auth', 'user-role:customer'])->group(function () {
    Route::get('/customer', [ListingsController::class, 'home'])->name('customer.home');
});
