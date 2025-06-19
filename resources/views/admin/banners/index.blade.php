@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10 px-2 md:px-8">
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-primary hover:text-white transition font-semibold shadow-sm">
                    ← Back
                </a>
                <h1 class="text-2xl font-bold text-primary">Banners</h1>
            </div>
            <div class="w-full sm:w-auto">
                <a href="{{ route('admin.banners.create') }}" class="block w-full sm:w-auto bg-primary text-white px-4 py-2 rounded font-semibold hover:bg-primary/80 transition-all text-base text-center mt-2 sm:mt-0">
                    + Tambah Banner
                </a>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-2 border-orange-400 rounded-xl shadow-lg">
            <thead class="bg-primary text-white font-bold">
                <tr>
                    <th class="py-3 px-4 border-2 border-orange-400 rounded-tl-xl">#</th>
                    <th class="py-3 px-4 border-2 border-orange-400">News</th>
                    <th class="py-3 px-4 border-2 border-orange-400 rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr class="hover:bg-yellow-50 transition group">
                    <td class="py-3 px-4 border-2 border-orange-400 text-center align-middle">{{ $loop->iteration }}</td>
                    <td class="py-3 px-4 border-2 border-orange-400 align-middle">{{ $banner->news->title ?? '-' }}</td>
                    <td class="py-3 px-4 border-2 border-orange-400 text-center align-middle">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-400 transition shadow group-hover:scale-110" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-yellow-600 group-hover:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.466 18.823a4.2 4.2 0 0 1-1.768 1.06l-3.09.882.882-3.09a4.2 4.2 0 0 1 1.06-1.768L16.862 4.487ZM19.5 6.75l-1.5-1.5" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Yakin hapus banner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-full bg-red-100 hover:bg-red-400 transition shadow group-hover:scale-110" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600 group-hover:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-6 text-center text-gray-500 border-2 border-orange-400">Belum ada banner.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 