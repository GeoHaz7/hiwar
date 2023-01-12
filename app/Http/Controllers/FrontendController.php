<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FrontendController extends Controller
{
    public function index()
    {
        // $pages = Page::select('title', 'page_slug')->get();

        return view('frontend.index');
    }
    public function contact()
    {
        return view('frontend.contactUs');
    }

    //toggleLanguage
    public function toggleLang(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('localeFront', $request->lang);

        return redirect()->back();
    }
}
