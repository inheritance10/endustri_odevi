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
    Route::get('admin',[ProductsController::class,'index'])
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

    Route::post('product-update-post/{id}',[ProductsController::class,'ProductUpdatePost'])
        ->name('product-update-post');

    Route::get('product-delete/{id}',[ProductsController::class,'ProductSoftDelete'])
        ->name('product-delete');

    Route::get('product-restore/{id}',[ProductsController::class,'ProductRestore'])
        ->name('product-restore');

    /*ORDERS ROUTE*/

    Route::get('order',[OrderController::class,'index'])
        ->name('order');

    Route::get('order-add',[OrderController::class,'OrderAdd'])
        ->name('order-add');

    Route::post('order-add-post',[OrderController::class,'OrderAddPost'])
        ->name('order-add-post');



    /*VEHICLE ROUTE*/


    Route::get('vehicle',[Vehicle::class,'index'])
        ->name('vehicle');

    Route::post('model-add-post',[Vehicle::class,'VehicleModelAddPost'])
        ->name('model-add-post');

    Route::get('model-delete/{id}',[Vehicle::class,'VehicleModelDelete'])
        ->name('model-delete');


    Route::post('brand-add-post',[Vehicle::class,'VehicleBrandAddPost'])
        ->name('brand-add-post');

    Route::get('brand-delete/{id}',[Vehicle::class,'VehicleBrandDelete'])
        ->name('brand-delete');

    Route::get('get-models/{id}',[Vehicle::class,'GetVehicleModels'])
        ->name('get-models');

    /*LOGS ROUTE*/

    Route::get('logs',[MainController::class,'Logs'])
        ->name('logs');

});

Route::get('/', function () {
    return redirect()->route('admin.index');
});
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



