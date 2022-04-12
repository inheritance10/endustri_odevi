<?php
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
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
    Route::get('admin',[DefaultController::class,'index'])
        ->name('nedmin.index');

    /*USER ROUTE*/

    Route::get('user',[UserController::class,'index'])
        ->name('user');

    Route::get('useradd',[UserController::class,'UserAdd'])
        ->name('useradd');

    Route::post('useraddpost',[UserController::class,'UserAddPost'])
        ->name('useraddpost');

    Route::get('userupdate',[UserController::class,'UserUpdate'])
        ->name('userupdate');

    Route::post('userupdatepost',[UserController::class,'UserUpdatePost'])
        ->name('userupdatepost');



    /*PRODUCTS ROUTE*/

    Route::get('product',[ProductsController::class,'index'])
        ->name('product');

    Route::get('productadd',[ProductsController::class,'ProductAdd'])
        ->name('productadd');

    Route::post('productaddpost',[ProductsController::class,'ProductAddPost'])
        ->name('productaddpost');

    Route::get('productupdate',[ProductsController::class,'ProductUpdate'])
        ->name('productupdate');

    Route::post('productupdatepost',[ProductsController::class,'ProductUpdatePost'])
        ->name('productupdatepost');


    /*ORDERS ROUTE*/

    Route::get('order',[ProductsController::class,'index'])
        ->name('order');

    Route::get('orderadd',[OrderController::class,'OrderAdd'])
        ->name('orderadd');

    Route::post('orderaddpost',[OrderController::class,'OrderAddPost'])
        ->name('orderaddpost');

    Route::get('orderupdate',[OrderController::class,'OrderUpdate'])
        ->name('orderupdate');

    Route::post('orderupdatepost',[OrderController::class,'OrderUpdatePost'])
        ->name('orderupdatepost');


    /*VEHICLER MODELS ROUTE*/

});
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('deneme',[DefaultController::class,'deneme'])
    ->name('nedmin.deneme');

Route::get('nedmin/settings',[SettingsController::class,'index'])
    ->name('settings.index');



