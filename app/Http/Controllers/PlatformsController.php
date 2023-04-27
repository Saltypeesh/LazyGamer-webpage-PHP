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
        $platforms = Platform::latest()->paginate(6);
        return view('platforms.index', compact('platforms'));
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

        return view('platforms.show', ['platform' => $platform]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        return view('platforms.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platform $platform)
    {
        $request = $request->validate([
            'platname' => 'required|string|max:50'
        ]);
        $platform->update($request);
        return redirect('/platforms')->with('message', 'Platform updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $platform)
    {
        $platform->delete();
        return redirect('/platforms')->with('message', 'Platform deleted successfully!');
    }
}
