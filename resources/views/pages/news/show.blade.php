@extends('layouts.app')

@section('title', $news->title)

@section('content')
<!-- Detail Berita -->
<div class="flex flex-col px-4 lg:px-14 mt-10">
    <div class="font-bold text-xl lg:text-2xl mb-6 text-center lg:text-left">
        <p>{{ $news->title }}</p>
    </div>
    <div class="flex flex-col lg:flex-row w-full gap-10">
        <!-- Berita Utama -->
        <div class="lg:w-8/12">
            <img src="{{ asset('storage/thumbnails/' . $news->thumbnail) }}" alt="Gambar Berita"
                class="w-full max-h-96 rounded-xl object-cover">

            <article class="mt-5">
                {!! $news->content !!}
            </article>

            <!-- Komentar -->
            <div class="mt-10">
                <h2 class="text-xl font-semibold mb-4">Komentar</h2>
                <div id="comments-list" class="space-y-4">
                    <p class="text-gray-500">Memuat komentar...</p>
                </div>
            </div>

            <!-- Form Komentar (ditampilkan via JavaScript jika token tersedia) -->
            <div id="comment-section" class="mt-10 hidden">
                <h3 class="text-lg font-semibold mb-2">Tinggalkan Komentar</h3>
                <form id="comment-form" class="space-y-4">
                    <textarea id="comment-content" class="w-full border p-3 rounded" placeholder="Tulis komentar..." required></textarea>
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded">Kirim</button>
                </form>
                <div id="comment-error" class="text-red-600 mt-2 hidden"></div>
            </div>
        </div>

        <!-- Berita Terbaru -->
        <div class="lg:w-4/12 flex flex-col gap-10">
            <div class="sticky top-24 z-40">
                <p class="font-bold mb-8 text-xl lg:text-2xl">Berita Terbaru Lainnya</p>
                <div class="gap-5 flex flex-col">
                    @foreach ($newests as $new)
                        <a href="{{ route('news.show', $new->slug) }}">
                            <div class="flex gap-3 border border-slate-300 hover:border-primary p-3 rounded-xl">
                                <div class="bg-primary text-white rounded-full w-fit px-5 py-1 ml-2 mt-2 font-normal text-xs absolute">
                                    {{ $new->newsCategory->title }}
                                </div>
                                <div class="flex gap-3 flex-col lg:flex-row">
                                    <img src="{{ $new->thumbnail ? asset('storage/' . $new->thumbnail) : asset('assets/img/Berita-Demo.png') }}"
                                         class="max-h-36 rounded-xl object-cover" style="width: 200px;">
                                    <div>
                                        <p class="font-bold text-sm lg:text-base">{{ \Str::limit($new->title, 40) }}</p>
                                        <p class="text-slate-400 mt-2 text-sm lg:text-xs">
                                            {!! \Str::limit($new->content, 30) !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Author Section -->
<div class="flex flex-col gap-4 mb-10 p-4 lg:p-10 lg:px-14 w-full lg:w-2/3">
    <p class="font-semibold text-xl lg:text-2xl mb-2">Author</p>
    <a href="{{ route('author.show', $news->author->username) }}">
        <div class="flex flex-col lg:flex-row gap-4 items-center border border-slate-300 rounded-xl p-6 lg:p-8 hover:border-primary transition">
            <img src="{{ $news->author->avatar ? asset('storage/avatars/' . $news->author->avatar) : asset('assets/img/User.png') }}"
                 alt="profile" class="rounded-full w-24 lg:w-28 border-2 border-primary">
            <div class="text-center lg:text-left">
                <p class="font-bold text-lg lg:text-xl">{{ $news->author->name }}</p>
                <p class="text-sm lg:text-base leading-relaxed">
                    {{ \Str::limit($news->author->bio, 100) }}
                </p>
            </div>
        </div>
    </a>
</div>

<!-- Script Komentar -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const newsId = {{ $news->id }};
    const token = localStorage.getItem("token");

    // 1. Tampilkan form komentar jika token tersedia
    if (token) {
        document.getElementById("comment-section")?.classList.remove("hidden");
    }

    // 2. Ambil komentar dari API
    fetch(`/api/news/${newsId}/comments`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("comments-list");
            container.innerHTML = '';
            if (data.length === 0) {
                container.innerHTML = '<p class="text-gray-500">Belum ada komentar.</p>';
                return;
            }
            data.forEach(comment => {
                const div = document.createElement("div");
                div.className = "border p-3 rounded bg-gray-100";
                div.innerHTML = `<strong>${comment.user.name}</strong><p>${comment.content}</p>`;
                container.appendChild(div);
            });
        });

    // 3. Kirim komentar
    document.getElementById("comment-form")?.addEventListener("submit", async function(e) {
        e.preventDefault();
        const content = document.getElementById("comment-content").value;
        const errorDiv = document.getElementById("comment-error");
        errorDiv.classList.add("hidden");

        try {
            const response = await fetch("/api/comments", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token,
                },
                body: JSON.stringify({
                    news_id: newsId,
                    content: content
                })
            });

            const data = await response.json();

            if (!response.ok) {
                const message = data.message || "Gagal mengirim komentar.";
                errorDiv.innerText = message;
                errorDiv.classList.remove("hidden");
            } else {
                window.location.reload(); // sukses
            }
        } catch (err) {
            errorDiv.innerText = "Terjadi kesalahan.";
            errorDiv.classList.remove("hidden");
        }
    });
});
</script>
@endsection
