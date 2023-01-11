<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        ///get file name of logged in user
        view()->composer('*', function ($view) {

            $pages = Page::select('title', 'page_slug', 'brief', 'description', 'feature_image')->get();

            view()->share('pages', $pages);


            if (!Auth::check()) {
                $Data = null;
            } else {

                if (Auth::user()->type == 2) {

                    $Data = DB::table('vendors')->select('filename', 'user_id', 'full_name')
                        ->leftjoin('images', 'images.image_id', '=', 'vendors.profile_image')
                        ->where('user_id', Auth::user()->user_id)->first();
                } else {
                    $Data = DB::table('users')->select('username', 'type')
                        ->where('user_id', Auth::user()->user_id)->first();

                    $Data->full_name = $Data->username;
                    $Data->filename = null;
                }


                $view->with('data', $Data);
            }
        });
    }
}
