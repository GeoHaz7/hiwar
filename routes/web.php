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

Route::get('/vendor/data', [App\Http\Controllers\VendorController::class, 'index'])->name('vendor.data');
Route::get('/vendor', [App\Http\Controllers\VendorController::class, 'show'])->name('vendor.list');
Route::get('/vendor/create', [App\Http\Controllers\VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor/store', [App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');
Route::get('/vendor/edit/{id}', [App\Http\Controllers\VendorController::class, 'edit'])->name('vendor.edit');
Route::post('/vendor/update/{id}', [App\Http\Controllers\VendorController::class, 'update'])->name('vendor.update');
Route::delete('/vendor/destroy/{id}', [App\Http\Controllers\VendorController::class, 'destroy'])->name('vendor.destroy');

Route::get('/page/data', [App\Http\Controllers\PagesController::class, 'index'])->name('page.data');
Route::get('/page', [App\Http\Controllers\PagesController::class, 'show'])->name('page.list');
Route::get('/page/create', [App\Http\Controllers\PagesController::class, 'create'])->name('page.create');
Route::post('/page/store', [App\Http\Controllers\PagesController::class, 'store'])->name('page.store');
Route::get('/page/edit/{id}', [App\Http\Controllers\PagesController::class, 'edit'])->name('page.edit');
Route::post('/page/update/{id}', [App\Http\Controllers\PagesController::class, 'update'])->name('page.update');
// Route::delete('/vendor/destroy/{id}', [App\Http\Controllers\VendorController::class, 'destroy'])->name('vendor.destroy');
