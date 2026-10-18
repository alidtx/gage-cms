<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\FrontendHero;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(Request $request, FrontendHero $heroes): View
    {
        $recentNews = News::publiclyVisible()->with('category')
            ->orderByDesc('published_at')->orderByDesc('id')->limit(3)->get();

        return view('frontend.pages.home', ['recentNews' => $recentNews, 'heroContent' => $heroes->forPage('home')]);
    }

    public function about(Request $request, FrontendHero $heroes): View
    {
        return view('frontend.pages.about', ['heroContent' => $heroes->forPage('about')]);
    }

    public function gageSecurity(Request $request, FrontendHero $heroes): View
    {
        return view('frontend.pages.gage-security', ['companyTheme' => 'security', 'heroContent' => $heroes->forPage('gage_security')]);
    }

    public function gageFireSafety(Request $request, FrontendHero $heroes): View
    {
        return view('frontend.pages.gage-fire-safety', ['companyTheme' => 'fire-safety', 'heroContent' => $heroes->forPage('gage_fire_safety')]);
    }

    public function gageTrainingInstruction(Request $request, FrontendHero $heroes): View
    {
        return view('frontend.pages.gage-training-instruction', ['companyTheme' => 'training', 'heroContent' => $heroes->forPage('gage_training_instruction')]);
    }

    public function gageTechnology(Request $request, FrontendHero $heroes): View
    {
        return view('frontend.pages.gage-technology', ['companyTheme' => 'technology', 'heroContent' => $heroes->forPage('gage_technology')]);
    }

    public function gageProjectClient(Request $request, FrontendHero $heroes): View
    {
        return view('frontend.pages.gage-project-client', ['heroContent' => $heroes->forPage('gage_project_client')]);
    }
}
