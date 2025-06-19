@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10 max-w-lg">
    <h1 class="text-2xl font-bold mb-6 text-primary">Edit News</h1>
    <form method="POST" action="{{ route('admin.news.update', $news->id) }}" class="bg-white p-8 rounded shadow border space-y-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1 font-semibold">Judul</label>
            <input type="text" name="title" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required value="{{ old('title', $news->title) }}">
            @error('title')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Slug</label>
            <input type="text" name="slug" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required value="{{ old('slug', $news->slug) }}">
            @error('slug')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Author</label>
            <select name="author_id" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required>
                <option value="">Pilih Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" @selected(old('author_id', $news->author_id) == $author->id)>{{ $author->name }}</option>
                @endforeach
            </select>
            @error('author_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Kategori</label>
            <select name="news_category_id" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('news_category_id', $news->news_category_id) == $cat->id)>{{ $cat->title }}</option>
                @endforeach
            </select>
            @error('news_category_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            @include('components.upload-thumbnail')
            @if($news->thumbnail)
                <div class="mt-2">
                    <span class="text-sm text-gray-500">Thumbnail saat ini:</span>
                    <img src="{{ asset('storage/thumbnails/' . $news->thumbnail) }}" class="w-32 h-20 object-cover rounded border mt-1">
                </div>
            @endif
        </div>
        <div>
            <label class="block mb-1 font-semibold">Isi Berita</label>
            <textarea name="content" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required>{{ old('content', $news->content) }}</textarea>
            @error('content')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex items-center gap-2 mb-4">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $news->is_featured))>
            <label class="font-semibold">Featured</label>
        </div>
        <div class="flex gap-2 mt-6">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded font-semibold hover:bg-primary/80 transition">Update</button>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded font-semibold hover:bg-gray-400 transition">Kembali</a>
        </div>
    </form>
</div>
@endsection 