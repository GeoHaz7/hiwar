<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
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


//Frontend Index




Route::group(
    ['middleware' => 'frontendMiddlware'],
    function () {
        Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
        Route::get('/contact-us', [App\Http\Controllers\FrontendController::class, 'contact'])->name('front.contact');
    }
);
