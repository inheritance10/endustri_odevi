<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Vehicle;
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
Route::middleware(['auth'])->group(function () {
    Route::get('admin',[MainController::class,'index'])
        ->name('admin.index');

    /*USER ROUTE*/

    Route::get('user',[UserController::class,'index'])
        ->name('user');

    Route::get('user-add',[UserController::class,'UserAdd'])
        ->name('user-add');

    Route::post('user-add-post',[UserController::class,'UserAddPost'])
        ->name('user-add-post');

    Route::get('user-update',[UserController::class,'UserUpdate'])
        ->name('user-update');

    Route::post('user-update-post',[UserController::class,'UserUpdatePost'])
        ->name('user-update-post');



    /*PRODUCTS ROUTE*/

    Route::get('product',[ProductsController::class,'index'])
        ->name('product-index');

    Route::get('product-add',[ProductsController::class,'ProductAdd'])
        ->name('product-add');

    Route::post('product-add-post',[ProductsController::class,'ProductAddPost'])
        ->name('product-add-post');

    Route::get('product-update/{id}',[ProductsController::class,'ProductUpdate'])
        ->name('product-update');

    Route::post('product-update-post',[ProductsController::class,'ProductUpdatePost'])
        ->name('product-update-post');

    /*ORDERS ROUTE*/

    Route::get('order',[OrderController::class,'index'])
        ->name('order');

    Route::get('order-add',[OrderController::class,'OrderAdd'])
        ->name('order-add');

    Route::post('order-add-post',[OrderController::class,'OrderAddPost'])
        ->name('order-add-post');

    Route::get('order-update',[OrderController::class,'OrderUpdate'])
        ->name('order-update');

    Route::post('order-update-post',[OrderController::class,'OrderUpdatePost'])
        ->name('order-update-post');


    /*VEHICLE ROUTE*/

    Route::get('vehicle-model',[Vehicle::class,'VehicleModelIndex'])
        ->name('vehicle-model');

    Route::get('vehicle-brand',[Vehicle::class,'VehicleBrandIndex'])
        ->name('vehicle-brand');

});

Route::get('/', function () {
    return redirect()->route('admin.index');
});
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



