<?php

use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;

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
        Route::get('/front/page/{slug?}', function ($slug) {
            $page = Page::where('page_slug', $slug)->where('status', 1)
                ->firstOrFail();

            return View::make('frontend.showPage')->with('page', $page);
        });
        //change langue route
        Route::get('/lang/toggle', [App\Http\Controllers\FrontendController::class, 'toggleLang'])->name('changeLangFront');
    }
);
