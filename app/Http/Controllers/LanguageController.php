<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeBack(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('localeBack', $request->lang);

        return redirect()->back();
    }

    public function changeFront(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('localeFront', $request->lang);

        return redirect()->back();
    }
}
