<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('platforms.index', ['platform' => Platform::latest()->paginate(6)]);
    }

    /**
     * Show the form for creating a category.
     */
    public function create()
    {
        return view('platforms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $platform = $request->validate(['platname' => 'required|string|max:50']);
        Platform::create($platform);
        return redirect('/platforms')->with('message', 'Platform created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform)
    {
        return view('platforms.view', ['platform' => $platform]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        return view('platforms.edit', ['platform' => $platform]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platform $platform)
    {
        $platform = $request->validate([
            'platname' => 'required|string|max:50'
        ]);
        Platform::create($platform);
        return back()->with('message', 'Platform updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $platform)
    {
        $platform->delete();
        return back()->with('message', 'Platform updated successfully!');
    }
}
