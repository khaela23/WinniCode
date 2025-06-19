@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10 max-w-lg">
    <h1 class="text-2xl font-bold mb-6 text-primary">Tambah News</h1>
    <form method="POST" action="{{ route('admin.news.store') }}" class="bg-white p-6 rounded shadow" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="title" class="w-full border px-3 py-2 rounded" required value="{{ old('title') }}">
            @error('title')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Slug</label>
            <input type="text" name="slug" class="w-full border px-3 py-2 rounded" required value="{{ old('slug') }}">
            @error('slug')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Author</label>
            <select name="author_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Pilih Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" @selected(old('author_id') == $author->id)>{{ $author->name }}</option>
                @endforeach
            </select>
            @error('author_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="news_category_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('news_category_id') == $cat->id)>{{ $cat->title }}</option>
                @endforeach
            </select>
            @error('news_category_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        @include('components.upload-thumbnail')
        <div class="mb-4">
            <label class="block mb-1">Isi Berita</label>
            <textarea name="content" class="w-full border px-3 py-2 rounded" required>{{ old('content') }}</textarea>
            @error('content')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="mb-6 flex items-center gap-2">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))>
            <label>Featured</label>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded font-semibold">Simpan</button>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded font-semibold">Kembali</a>
        </div>
    </form>
</div>
<script>
    function previewThumbnail(event) {
        const preview = document.getElementById('thumbnail-preview');
        preview.innerHTML = '';
        const file = event.target.files[0];
        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-32 h-20 object-cover rounded border mt-2';
            preview.appendChild(img);
        }
    }
</script>
@endsection 