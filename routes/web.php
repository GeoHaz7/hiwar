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

require_once 'frontend.php';



Auth::routes();


Route::group(
    ['middleware' => 'auth'],
    function () {

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
        Route::post('/page/switchMenu/{id}', [App\Http\Controllers\PagesController::class, 'switchMenu'])->name('page.switchMenu');
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

        Route::get('/album/data', [App\Http\Controllers\AlbumController::class, 'index'])->name('album.data');
        Route::get('/album', [App\Http\Controllers\AlbumController::class, 'show'])->name('album.list');
        Route::get('/album/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('album.create');
        Route::post('/album/store', [App\Http\Controllers\AlbumController::class, 'store'])->name('album.store');
        Route::get('/album/edit/{id}', [App\Http\Controllers\AlbumController::class, 'edit'])->name('album.edit');
        Route::post('/album/update/{id}', [App\Http\Controllers\AlbumController::class, 'update'])->name('album.update');
        Route::delete('/album/destroy/{id}', [App\Http\Controllers\AlbumController::class, 'destroy'])->name('album.destroy');

        Route::get('/cart/list', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
        Route::get('/cart/my', [App\Http\Controllers\CartController::class, 'show'])->name('cart.show');
        Route::get('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.addTo');
        Route::get('/cart/itemTotal', [App\Http\Controllers\CartController::class, 'getCartTotalItems'])->name('cart.totalItems');


        Route::get('/video/data', [App\Http\Controllers\VideoAlbumController::class, 'index'])->name('videoAlbum.data');
        Route::get('/video', [App\Http\Controllers\VideoAlbumController::class, 'show'])->name('videoAlbum.list');
        Route::post('/video/store', [App\Http\Controllers\VideoAlbumController::class, 'store'])->name('videoAlbum.store');
        Route::delete('/video/destroy/{id}', [App\Http\Controllers\VideoAlbumController::class, 'destroy'])->name('videoAlbum.destroy');


        Route::get('/option/data', [App\Http\Controllers\OptionController::class, 'index'])->name('option.data');
        Route::get('/option', [App\Http\Controllers\OptionController::class, 'show'])->name('option.list');
        Route::post('/option/update', [App\Http\Controllers\OptionController::class, 'update'])->name('option.update');


        //image routes
        Route::get('/image/show/', [ImagesController::class, 'show'])->name('image.show');
        Route::post('/image/store', [ImagesController::class, 'store'])->name('image.store');
        Route::post('/image/delete', [ImagesController::class, 'delete'])->name('image.delete');

        //get categories Data Ajax
        Route::get('/vendors/ajax/', [Select2Controller::class, 'vendorDataAjax'])->name('vendors.dataAjax');

        //show categories Data Ajax
        Route::get('/vendors/ajax/show/{id}', [Select2Controller::class, 'showVendorDataAjax'])->name('vendors.showDataAjax');
    }



);
