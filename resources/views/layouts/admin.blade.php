<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="{{ asset('assets/css/output.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-primary text-white flex flex-col py-8 px-4 sticky top-0 min-h-screen">
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-orange-400 transition {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 font-bold' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.authors.index') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-orange-400 transition {{ request()->is('admin/authors*') ? 'bg-orange-500 font-bold' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Authors
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-orange-400 transition {{ request()->is('admin/news*') ? 'bg-orange-500 font-bold' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v12a2 2 0 01-2 2z"/></svg>
                            News
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-orange-400 transition {{ request()->is('admin/banners*') ? 'bg-orange-500 font-bold' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            Banners
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news-categories.index') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-orange-400 transition {{ request()->is('admin/news-categories*') ? 'bg-orange-500 font-bold' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/></svg>
                            News Categories
                        </a>
                    </li>
                </ul>
            </nav>
            <form method="GET" action="{{ route('logout') }}" class="mt-10">
                <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-orange-400 transition w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/></svg>
                    Logout
                </button>
            </form>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
</body>
</html> 