<?php
use App\Http\Controllers\Backend\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DefaultController;
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


Route::get('admin',[DefaultController::class,'index'])
    ->name('nedmin.index');

Route::get('deneme',[DefaultController::class,'deneme'])
    ->name('nedmin.deneme');


Route::get('nedmin/settings',[SettingsController::class,'index'])
    ->name('settings.index');
