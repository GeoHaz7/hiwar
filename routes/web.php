<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoAlbumController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Select2Controller;

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
Route::get('/vendors', [App\Http\Controllers\VendorController::class, 'show'])->name('vendor.list');
Route::get('/vendor/create', [App\Http\Controllers\VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor/store', [App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');
Route::post('/vendor/switch/{id}', [App\Http\Controllers\VendorController::class, 'switch'])->name('vendor.switch');
Route::get('/vendor/edit/{id}', [App\Http\Controllers\VendorController::class, 'edit'])->name('vendor.edit');
Route::post('/vendor/update/{id}', [App\Http\Controllers\VendorController::class, 'update'])->name('vendor.update');
Route::delete('/vendor/destroy/{id}', [App\Http\Controllers\VendorController::class, 'destroy'])->name('vendor.destroy');

Route::get('/page/data', [App\Http\Controllers\PagesController::class, 'index'])->name('page.data');
Route::get('/page', [App\Http\Controllers\PagesController::class, 'show'])->name('page.list');
Route::get('/page/create', [App\Http\Controllers\PagesController::class, 'create'])->name('page.create');
Route::post('/page/store', [App\Http\Controllers\PagesController::class, 'store'])->name('page.store');
Route::post('/page/switch/{id}', [App\Http\Controllers\PagesController::class, 'switch'])->name('page.switch');
Route::get('/page/edit/{id}', [App\Http\Controllers\PagesController::class, 'edit'])->name('page.edit');
Route::post('/page/update/{id}', [App\Http\Controllers\PagesController::class, 'update'])->name('page.update');
Route::delete('/page/destroy/{id}', [App\Http\Controllers\PagesController::class, 'destroy'])->name('page.destroy');

Route::get('/product/data', [App\Http\Controllers\ProductController::class, 'index'])->name('product.data');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'show'])->name('product.list');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::post('/product/switch/{id}', [App\Http\Controllers\ProductController::class, 'switch'])->name('product.switch');
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::delete('/product/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/news/data', [App\Http\Controllers\NewsController::class, 'index'])->name('news.data');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'show'])->name('news.list');
Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
Route::post('/news/switch/{id}', [App\Http\Controllers\NewsController::class, 'switch'])->name('news.switch');
Route::get('/news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/update/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
Route::delete('/news/destroy/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');


Route::get('/video/data', [App\Http\Controllers\VideoAlbumController::class, 'index'])->name('videoAlbum.data');
Route::get('/video', [App\Http\Controllers\VideoAlbumController::class, 'show'])->name('videoAlbum.list');
Route::post('/video/store', [App\Http\Controllers\VideoAlbumController::class, 'store'])->name('videoAlbum.store');
Route::delete('/video/destroy/{id}', [App\Http\Controllers\VideoAlbumController::class, 'destroy'])->name('videoAlbum.destroy');


//image routes
Route::get('/image/show/', [ImagesController::class, 'show'])->name('image.show');
Route::post('/image/store', [ImagesController::class, 'store'])->name('image.store');
Route::post('/image/delete', [ImagesController::class, 'delete'])->name('image.delete');

//get categories Data Ajax
Route::get('/vendors/ajax/', [Select2Controller::class, 'vendorDataAjax'])->name('vendors.dataAjax');

//show categories Data Ajax
Route::get('/vendors/ajax/show/{id}', [Select2Controller::class, 'showVendorDataAjax'])->name('vendors.showDataAjax');
