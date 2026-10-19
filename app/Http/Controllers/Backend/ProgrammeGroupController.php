<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProgrammeGroupRequest;
use App\Models\ProgrammeGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ProgrammeGroupController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/Program/Catalogue', ['kind' => 'programme-groups', 'records' => ProgrammeGroup::withCount('divisions')->orderBy('sort_order')->orderBy('id')->paginate(15), 'options' => []]);
    }

    public function store(SaveProgrammeGroupRequest $request): RedirectResponse
    {
        ProgrammeGroup::create($request->validated());

        return to_route('backend.programme-groups.index');
    }

    public function update(SaveProgrammeGroupRequest $request, ProgrammeGroup $programmeGroup): RedirectResponse
    {
        $programmeGroup->update($request->validated());

        return to_route('backend.programme-groups.index');
    }

    public function destroy(ProgrammeGroup $programmeGroup): RedirectResponse
    {
        if ($programmeGroup->divisions()->exists()) {
            throw ValidationException::withMessages(['delete' => 'Remove or reassign its divisions first.']);
        }
        $programmeGroup->delete();

        return to_route('backend.programme-groups.index');
    }
}
