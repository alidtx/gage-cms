<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(Request $request): View
    {
        $recentNews = News::publiclyVisible()->with('category')
            ->orderByDesc('published_at')->orderByDesc('id')->limit(3)->get();

        return view('frontend.pages.home', compact('recentNews'));
    }

    public function about(Request $request)
    {
        return view('frontend.pages.about');
    }

    public function gageSecurity(Request $request)
    {
        return view('frontend.pages.gage-security', ['companyTheme' => 'security']);
    }

    public function gageFireSafety(Request $request)
    {
        return view('frontend.pages.gage-fire-safety', ['companyTheme' => 'fire-safety']);
    }

    public function gageTrainingInstruction(Request $request)
    {
        return view('frontend.pages.gage-training-instruction', ['companyTheme' => 'training']);
    }

    public function gageTechnology(Request $request)
    {
        return view('frontend.pages.gage-technology', ['companyTheme' => 'technology']);
    }

    public function gageProjectClient(Request $request)
    {
        return view('frontend.pages.gage-project-client');
    }
}
