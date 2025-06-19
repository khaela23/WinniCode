@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-primary">News Categories</h1>
        <a href="{{ route('admin.news-categories.create') }}" class="bg-primary text-white px-4 py-2 rounded font-semibold hover:bg-primary/80">+ Tambah Category</a>
    </div>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-2 border-orange-400 rounded-lg shadow">
            <thead class="bg-primary text-white font-bold">
                <tr>
                    <th class="py-2 px-4 border-2 border-orange-400">#</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Title</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Slug</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr class="hover:bg-orange-50 transition">
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $cat->title }}</td>
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $cat->slug }}</td>
                    <td class="py-2 px-4 flex gap-2 border-2 border-orange-400">
                        <a href="{{ route('admin.news-categories.edit', $cat->id) }}" class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-400 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-yellow-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.466 18.823a4.2 4.2 0 0 1-1.768 1.06l-3.09.882.882-3.09a4.2 4.2 0 0 1 1.06-1.768L16.862 4.487ZM19.5 6.75l-1.5-1.5" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.news-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-full bg-red-100 hover:bg-red-400 transition" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500 border-2 border-orange-400">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 