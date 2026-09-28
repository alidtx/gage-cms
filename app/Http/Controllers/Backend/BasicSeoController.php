<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BasicSeo;
use Illuminate\Http\Request;

class BasicSeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basicSeo = BasicSeo::first();
        return inertia('Backend/BasicSeo/Index', [
            'basicSeo' => $basicSeo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BasicSeo $basicSeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BasicSeo $basicSeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BasicSeo $basicSeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BasicSeo $basicSeo)
    {
        //
    }
}