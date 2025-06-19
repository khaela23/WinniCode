<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(News::all());
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
            'author_id' => 'required|exists:authors,id',
            'news_category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'thumbnail' => 'nullable|string',
            'content' => 'required|string',
            'is_featured' => 'boolean',
        ]);
        $news = News::create($validated);
        return response()->json($news, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        return response()->json($news);
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
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        $validated = $request->validate([
            'author_id' => 'sometimes|required|exists:authors,id',
            'news_category_id' => 'sometimes|required|exists:news_categories,id',
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:news,slug,' . $id,
            'thumbnail' => 'nullable|string',
            'content' => 'sometimes|required|string',
            'is_featured' => 'boolean',
        ]);
        $news->update($validated);
        return response()->json($news);
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
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        $news->delete();
        return response()->json(['message' => 'News deleted']);
    }
}
