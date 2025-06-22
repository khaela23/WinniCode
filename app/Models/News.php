<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment; // Tambahkan ini jika belum ada

class News extends Model
{
    protected $fillable = [
        'author_id',
        'news_category_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_featured'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    /**
     * Relasi: Berita memiliki banyak komentar
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
