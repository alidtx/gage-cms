<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingEnquiryRequest;
use App\Models\Division;
use App\Models\ProgrammeGroup;
use App\Services\FrontendHero;
use App\Services\FrontendSeo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(FrontendHero $heroes, FrontendSeo $seo): View
    {
        $groups = ProgrammeGroup::with(['divisions' => fn ($q) => $q->where('is_published', true)->orderBy('sort_order')->orderBy('number'), 'divisions.programmes' => fn ($q) => $q->published()->ordered()])->orderBy('sort_order')->orderBy('id')->get();

        return view('frontend.pages.programmes.index', ['groups' => $groups, 'companyTheme' => 'training', 'heroContent' => $heroes->forPage('gti_programmes'), 'pageSeo' => $seo->forPage('gti_programmes', ['title' => 'Programmes | GAGE Training Institute'])]);
    }

    public function show(Division $division, FrontendHero $heroes, FrontendSeo $seo): View
    {
        abort_unless($division->is_published, 404);
        $division->load(['programmes' => fn ($q) => $q->published()->ordered()->with('objectives')]);
        $others = Division::where('is_published', true)->whereKeyNot($division->id)->withCount(['programmes' => fn ($q) => $q->published()])->orderBy('sort_order')->orderBy('number')->limit(3)->get();

        return view('frontend.pages.programmes.show', ['division' => $division, 'others' => $others, 'companyTheme' => 'training', 'heroContent' => $heroes->forPage($division->slug), 'pageSeo' => $seo->forPage($division->slug, ['title' => $division->name.' | GAGE Training Institute'])]);
    }

    public function enquire(StoreTrainingEnquiryRequest $request, Division $division): RedirectResponse
    {
        abort_unless($division->is_published, 404);
        $data = $request->validated();
        $program = $division->programmes()->published()->findOrFail($data['programme_id']);
        unset($data['programme_id']);
        $program->enquiries()->create([...$data, 'programme_label' => $program->title, 'status' => 'new', 'source_page' => route('frontend.programmes.show', $division->slug), 'submitted_ip' => $request->ip()]);

        return redirect()->to(route('frontend.programmes.show', $division->slug).'#training-enquiry')->with('training_success', 'Thank you. We have received your training enquiry and will contact you.');
    }
}
