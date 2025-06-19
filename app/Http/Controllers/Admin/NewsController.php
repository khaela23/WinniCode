<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Author;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with(['author', 'newsCategory'])->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'news_category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|string',
            'is_featured' => 'boolean',
        ]);
        
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->storeAs('thumbnails', $filename, 'public');
            $validated['thumbnail'] = $filename; 
        }
        
        News::create($validated);
        return redirect()->route('admin.news.index')->with('success', 'News created!');
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
        $news = News::findOrFail($id);
        $authors = Author::all();
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'news_category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug,' . $id,
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|string',
            'is_featured' => 'boolean',
        ]);
        
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($news->thumbnail) {
                $oldPath = storage_path('app/public/thumbnails/' . $news->thumbnail);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            // Sanitize filename: only allow alphanumeric, dash, underscore, dot
            $file = $request->file('thumbnail');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->storeAs('thumbnails', $filename, 'public');
            $validated['thumbnail'] = $filename; // Store only filename
        }
        
        $news->update($validated);
        return redirect()->route('admin.news.index')->with('success', 'News updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted!');
    }
}
