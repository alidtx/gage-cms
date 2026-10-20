<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Entity;
use App\Models\News;
use App\Models\Service;
use App\Services\FrontendHero;
use App\Services\FrontendSeo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        $recentNews = News::publiclyVisible()->with('category')
            ->orderByDesc('published_at')->orderByDesc('id')->limit(3)->get();

        $entities = Entity::active()->with('media')->ordered()->get();

        return view('frontend.pages.home', ['entities' => $entities, 'recentNews' => $recentNews, 'heroContent' => $heroes->forPage('home'), 'pageSeo' => $seo->forPage('home')]);
    }

    public function about(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.about', ['heroContent' => $heroes->forPage('about'), 'pageSeo' => $seo->forPage('about')]);
    }

    public function gageSecurity(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-security', ['services' => $this->companyServices('gage_security'), 'companyTheme' => 'security', 'heroContent' => $heroes->forPage('gage_security'), 'pageSeo' => $seo->forPage('gage_security')]);
    }
    public function gageSecurityDetail(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-security-detail', ['services' => $this->companyServices('gage_security'), 'companyTheme' => 'security', 'heroContent' => $heroes->forPage('gage-security-detail'), 'pageSeo' => $seo->forPage('gage-security-detail')]);
    }

    public function gageFireSafety(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-fire-safety', ['services' => $this->companyServices('gage_fire_safety'), 'companyTheme' => 'fire-safety', 'heroContent' => $heroes->forPage('gage_fire_safety'), 'pageSeo' => $seo->forPage('gage_fire_safety')]);
    }
    public function gageFireSafetyDetail(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-fire-safety-detail', ['services' => $this->companyServices('gage_fire_safety'), 'companyTheme' => 'fire-safety', 'heroContent' => $heroes->forPage('gage-fire-safety-detail'), 'pageSeo' => $seo->forPage('gage-fire-safety-detail')]);
    }
    public function gageTrainingInstruction(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-training-instruction', ['divisions' => Division::where('is_published', true)->withCount(['programmes' => fn ($query) => $query->published()])->orderBy('sort_order')->orderBy('number')->get(), 'companyTheme' => 'training', 'heroContent' => $heroes->forPage('gage_training_instruction'), 'pageSeo' => $seo->forPage('gage_training_instruction')]);
    }

    public function gageTechnology(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-technology', ['services' => $this->companyServices('gage_technology'), 'companyTheme' => 'technology', 'heroContent' => $heroes->forPage('gage_technology'), 'pageSeo' => $seo->forPage('gage_technology')]);
    }

    public function gageProjectClient(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.gage-project-client', ['heroContent' => $heroes->forPage('gage_project_client'), 'pageSeo' => $seo->forPage('gage_project_client')]);
    }

    /** @return Collection<int, Service> */
    private function companyServices(string $slug): Collection
    {
        return Service::with('media')->whereHas('entity', fn ($query) => $query->active()->whereIn('slug', [$slug, str_replace('_', '-', $slug)]))->orderBy('id')->get();
    }
    public function solution(Request $request, FrontendHero $heroes, FrontendSeo $seo): View
    {
        return view('frontend.pages.solution', ['heroContent' => $heroes->forPage('solution'), 'pageSeo' => $seo->forPage('solution')]);
    }
}
