<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = NewsCategory::all();
        return view('admin.news-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news_categories,slug',
        ]);
        NewsCategory::create($validated);
        return redirect()->route('admin.news-categories.index')->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = NewsCategory::findOrFail($id);
        return view('admin.news-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = NewsCategory::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news_categories,slug,' . $id,
        ]);
        $category->update($validated);
        return redirect()->route('admin.news-categories.index')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = NewsCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.news-categories.index')->with('success', 'Category deleted!');
    }
}
