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
        return view('categories.index', ['category' => Platform::latest()->paginate(6)]);
    }

    /**
     * Show the form for creating a category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->validate(['categoryName' => 'required|string|max:50']);
        Platform::create($category);
        return redirect('/categories')->with('message', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $category)
    {
        return view('categories.view', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platform $category)
    {
        $category = $request->validate([
            'categoryName' => 'required|string|max:50'
        ]);
        Platform::create($category);
        return back()->with('message', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $category)
    {
        $category->delete();
        return back()->with('message', 'Category updated successfully!');
    }
}
