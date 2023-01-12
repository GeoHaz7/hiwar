<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeBack(Request $request)
    {
        if (session()->get('localeBack') == 'en') {
            App::setLocale('ar');
            session()->put('localeBack', 'ar');
        } else {
            App::setLocale('en');
            session()->put('localeBack', 'en');
        }

        return redirect()->back();
    }

    public function changeFront(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('localeFront', $request->lang);

        return redirect()->back();
    }
}
