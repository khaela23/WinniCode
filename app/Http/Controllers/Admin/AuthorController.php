<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:authors,username',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio' => 'nullable|string',
        ]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->storeAs('avatars', $filename, 'public');
            $validated['avatar'] = $filename;
        }
        Author::create($validated);
        return redirect()->route('admin.authors.index')->with('success', 'Author created!');
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
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:authors,username,' . $id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio' => 'nullable|string',
        ]);
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($author->avatar) {
                $oldPath = storage_path('app/public/avatars/' . $author->avatar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('avatar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->storeAs('avatars', $filename, 'public');
            $validated['avatar'] = $filename;
        }
        $author->update($validated);
        return redirect()->route('admin.authors.index')->with('success', 'Author updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Author deleted!');
    }
}
