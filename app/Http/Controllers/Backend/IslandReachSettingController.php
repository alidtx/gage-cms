<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IslandReachSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IslandReachSettingController extends Controller
{
    /**
     * Display the island reach setting.
     */
    public function index()
    {
        $islandReachSetting = IslandReachSetting::first();

        // If no record exists yet, provide a default empty object
        if (! $islandReachSetting) {
            $islandReachSetting = new IslandReachSetting([
                'name' => '',
                'atoll' => '',
                'description' => '',
                'latitude' => null,
                'longitude' => null,
                'location_type' => 'island',
                'is_featured' => false,
                'marker_color' => '#3388ff',
                'marker_icon' => '',
                'sort_order' => 0,
                'is_active' => true,
            ]);
            $islandReachSetting->id = null;
        }

        return Inertia::render('Backend/IslandreachSetting/Index', [
            'islandReachSetting' => $islandReachSetting,
        ]);
    }

    /**
     * Update the island reach setting.
     */
    public function update(Request $request, ?IslandReachSetting $islandReachSetting = null)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'atoll' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'location_type' => ['required', 'in:island,resort,city,airport,harbor,other'],
            'is_featured' => ['boolean'],
            'marker_color' => ['nullable', 'string', 'max:20'],
            'marker_icon' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        if ($islandReachSetting && $islandReachSetting->exists) {
            $islandReachSetting->update($validated);
        } else {
            // Create the singleton record if it doesn't exist
            $islandReachSetting = IslandReachSetting::create($validated);
        }

        return redirect()
            ->route('backend.island-reach-location.index')
            ->with('success', 'Island reach setting updated successfully.');
    }
}