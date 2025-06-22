<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentApiController extends Controller
{
    /**
     * Menyimpan komentar baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'news_id' => $request->news_id,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $comment->load('user') // sertakan relasi user
        ], 201);
    }

    /**
     * Menampilkan semua komentar untuk berita tertentu
     */
    public function index($news_id)
    {
        $comments = Comment::with('user:id,name') // hanya ambil nama user
                    ->where('news_id', $news_id)
                    ->latest()
                    ->get();

        return response()->json($comments);
    }
}
