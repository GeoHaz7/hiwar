<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/vendors/data', [App\Http\Controllers\VendorController::class, 'index'])->name('vendor.data');
Route::get('/vendors', [App\Http\Controllers\VendorController::class, 'show'])->name('vendor.list');

Route::get('/vendor/create', [App\Http\Controllers\VendorController::class, 'create'])->name('vendor.create');
