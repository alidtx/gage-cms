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
    public function gageSecurity(Request $request)
    {
        return view('frontend.pages.gage-security');
    }
    public function gageFireSafety(Request $request)
    {
        return view('frontend.pages.gage-fire-safety');
    }
    public function gageTrainingInstruction(Request $request)
    {
        return view('frontend.pages.gage-training-instruction');
    }

}
