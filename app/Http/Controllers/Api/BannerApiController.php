<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;

class BannerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Banner::all());
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
            'news_id' => 'required|exists:news,id',
        ]);
        $banner = Banner::create($validated);
        return response()->json($banner, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }
        return response()->json($banner);
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
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }
        $validated = $request->validate([
            'news_id' => 'sometimes|required|exists:news,id',
        ]);
        $banner->update($validated);
        return response()->json($banner);
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
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }
        $banner->delete();
        return response()->json(['message' => 'Banner deleted']);
    }
}
