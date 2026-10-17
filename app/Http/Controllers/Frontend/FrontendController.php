<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
     
    public function home(Request $request)
    {
        return view('frontend.pages.home');
    }

    public function about(Request $request)
    {
        return view('frontend.pages.about');
    }

    public function news(Request $request)
    {
        return view('frontend.pages.news');
    }

}
