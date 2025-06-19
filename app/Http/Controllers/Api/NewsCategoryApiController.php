<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;

class NewsCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(NewsCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news_categories,slug',
        ]);
        $category = NewsCategory::create($validated);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = NewsCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'News category not found'], 404);
        }
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $category = NewsCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'News category not found'], 404);
        }
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:news_categories,slug,' . $id,
        ]);
        $category->update($validated);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $category = NewsCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'News category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'News category deleted']);
    }
}
