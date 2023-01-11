<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

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
}
