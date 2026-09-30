<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\IslandReachSettingRequest;
use App\Models\IslandReachSetting;
use Inertia\Inertia;

class IslandReachSettingController extends Controller
{
    /**
     * List all island reach settings.
     */
    public function index()
    {
        return Inertia::render('Backend/IslandreachSetting/Index', [
            'islandReachSettings' => IslandReachSetting::query()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Store a newly created setting.
     */
    public function store(IslandReachSettingRequest $request)
    {
        IslandReachSetting::create($request->validated());

        return redirect()
            ->route('backend.island-reach-location.index')
            ->with('success', 'Island reach setting created successfully.');
    }

    /**
     * Update the specified setting.
     */
    public function update(IslandReachSettingRequest $request, IslandReachSetting $islandReachSetting)
    {
        $islandReachSetting->update($request->validated());

        return redirect()
            ->route('backend.island-reach-location.index')
            ->with('success', 'Island reach setting updated successfully.');
    }

    /**
     * Delete the specified setting.
     */
    public function destroy(IslandReachSetting $islandReachSetting)
    {
        $islandReachSetting->delete();

        return redirect()
            ->route('backend.island-reach-location.index')
            ->with('success', 'Island reach setting deleted successfully.');
    }
}