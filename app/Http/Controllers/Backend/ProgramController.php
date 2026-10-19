<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProgramRequest;
use App\Models\Division;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProgramController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/Program/Catalogue', ['kind' => 'programs', 'records' => Program::with(['division:id,name,number', 'objectives'])->ordered()->orderBy('id')->paginate(15), 'options' => Division::orderBy('number')->get(['id', 'name'])]);
    }

    public function store(SaveProgramRequest $request): RedirectResponse
    {
        $this->save(new Program, $request->validated());

        return to_route('backend.programs.index');
    }

    public function update(SaveProgramRequest $request, Program $program): RedirectResponse
    {
        $this->save($program, $request->validated());

        return to_route('backend.programs.index');
    }

    /** @param array<string, mixed> $data */
    private function save(Program $program, array $data): void
    {
        DB::transaction(function () use ($program, $data): void {
            $objectives = $data['objectives'];
            unset($data['objectives']);
            $data['search_text'] = Str::lower($data['title'].' '.($data['code'] ?? ''));
            $program->fill($data)->save();
            $program->objectives()->delete();
            foreach ($objectives as $order => $body) {
                $program->objectives()->create(['body' => $body, 'sort_order' => $order]);
            }
        });
    }

    public function destroy(Program $program): RedirectResponse
    {
        $program->delete();

        return to_route('backend.programs.index');
    }
}
