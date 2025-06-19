<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\News;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with('news')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = News::all();
        return view('admin.banners.create', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'news_id' => 'required|exists:news,id',
        ]);
        Banner::create($validated);
        return redirect()->route('admin.banners.index')->with('success', 'Banner created!');
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
        $banner = Banner::findOrFail($id);
        $news = News::all();
        return view('admin.banners.edit', compact('banner', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $validated = $request->validate([
            'news_id' => 'required|exists:news,id',
        ]);
        $banner->update($validated);
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted!');
    }
}
