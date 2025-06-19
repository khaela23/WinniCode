@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10 max-w-lg">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-primary hover:text-white transition font-semibold">
            ← Back
        </a>
        <h1 class="text-2xl font-bold text-primary">Tambah Author</h1>
    </div>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded shadow">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.authors.store') }}" class="bg-white p-8 rounded shadow border space-y-5" enctype="multipart/form-data">
        @csrf
        <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required value="{{ old('name') }}">
            @error('name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block mb-1 font-semibold">Username</label>
            <input type="text" name="username" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary" required value="{{ old('username') }}">
            @error('username')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        @include('components.upload-avatar')
        <div>
            <label class="block mb-1 font-semibold">Bio</label>
            <textarea name="bio" class="w-full border px-3 py-2 rounded focus:ring-primary focus:border-primary">{{ old('bio') }}</textarea>
            @error('bio')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex gap-2 mt-6">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded font-semibold hover:bg-primary/80 transition">Simpan</button>
            <a href="{{ route('admin.authors.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded font-semibold hover:bg-gray-400 transition">Kembali</a>
        </div>
    </form>
</div>
@endsection 