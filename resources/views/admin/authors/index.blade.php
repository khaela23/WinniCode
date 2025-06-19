@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-primary hover:text-white transition font-semibold">
                ← Back
            </a>
            <h1 class="text-2xl font-bold text-primary">Authors</h1>
        </div>
        <a href="{{ route('admin.authors.create') }}" class="bg-primary text-white px-4 py-2 rounded font-semibold hover:bg-primary/80 transition">+ Tambah Author</a>
    </div>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded shadow">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-2 border-orange-400 rounded-lg shadow">
            <thead class="bg-primary text-white font-bold">
                <tr>
                    <th class="py-2 px-4 border-2 border-orange-400">#</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Name</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Username</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Avatar</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Bio</th>
                    <th class="py-2 px-4 border-2 border-orange-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                <tr class="hover:bg-orange-50 transition">
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $author->name }}</td>
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $author->username }}</td>
                    <td class="py-2 px-4 border-2 border-orange-400">
                        @if($author->avatar)
                            <img src="{{ asset('storage/avatars/' . $author->avatar) }}" alt="avatar" class="w-10 h-10 rounded-full object-cover border border-primary">
                        @else
                            <img src="{{ asset('assets/img/User.png') }}" alt="avatar" class="w-10 h-10 rounded-full object-cover border border-primary">
                        @endif
                    </td>
                    <td class="py-2 px-4 border-2 border-orange-400">{{ $author->bio }}</td>
                    <td class="py-2 px-4 flex gap-2 border-2 border-orange-400">
                        <a href="{{ route('admin.authors.edit', $author->id) }}" class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-400 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-yellow-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.466 18.823a4.2 4.2 0 0 1-1.768 1.06l-3.09.882.882-3.09a4.2 4.2 0 0 1 1.06-1.768L16.862 4.487ZM19.5 6.75l-1.5-1.5" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" onsubmit="return confirm('Yakin hapus author ini?')">
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
                    <td colspan="6" class="py-4 text-center text-gray-500 border-2 border-orange-400">Belum ada author.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 