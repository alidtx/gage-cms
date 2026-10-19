<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveDivisionRequest;
use App\Models\Division;
use App\Models\ProgrammeGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class DivisionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/Program/Catalogue', ['kind' => 'divisions', 'records' => Division::with('group:id,name')->withCount('programmes')->orderBy('sort_order')->orderBy('id')->paginate(15), 'options' => ProgrammeGroup::orderBy('sort_order')->orderBy('name')->get(['id', 'name'])]);
    }

    public function store(SaveDivisionRequest $request): RedirectResponse
    {
        Division::create($request->validated());

        return to_route('backend.divisions.index');
    }

    public function update(SaveDivisionRequest $request, Division $division): RedirectResponse
    {
        $division->update($request->validated());

        return to_route('backend.divisions.index');
    }

    public function destroy(Division $division): RedirectResponse
    {
        if ($division->programmes()->exists()) {
            throw ValidationException::withMessages(['delete' => 'Remove or reassign its programmes first.']);
        }
        $division->delete();

        return to_route('backend.divisions.index');
    }
}
