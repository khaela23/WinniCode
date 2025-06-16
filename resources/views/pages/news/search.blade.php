@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Hasil pencarian: "{{ $keyword }}"</h2>

    @if($news->count())
        <div class="grid grid-cols-1 gap-4">
            @foreach($news as $item)
                <div class="p-4 border rounded shadow">
                    <a href="{{ route('news.show', $item->slug) }}">
                        <h3 class="text-lg font-semibold">{{ $item->title }}</h3>
                    </a>
                    <p class="text-sm text-gray-600">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                    </p>
                    <p class="text-xs mt-2 text-gray-400">
                        Kategori: {{ $item->newsCategory->name ?? '-' }} | Penulis: {{ $item->author->name ?? '-' }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Tidak ada hasil ditemukan untuk kata kunci "<strong>{{ $keyword }}</strong>".</p>
    @endif
@endsection
