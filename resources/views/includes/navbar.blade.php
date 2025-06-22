<!-- Nav -->
<div class="sticky top-0 z-50 flex justify-between py-5 px-4 lg:px-14 bg-primary shadow-sm">
    <div class="flex gap-10 w-full">
        <!-- Logo dan Menu -->
        <div class="flex items-center justify-between w-full lg:w-auto">
            <!-- Logo -->
            <a href="{{ route('landing') }}" class="group">
                <div class="flex items-center gap-2 transition-transform duration-300 group-hover:scale-105">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="w-8 lg:w-10">
                    <p class="text-lg lg:text-xl font-bold text-white group-hover:text-yellow-300 transition-colors duration-300">WinniCode</p>
                </div>
            </a>
            <button class="lg:hidden text-white text-2xl focus:outline-none hover:text-yellow-300 transition-colors duration-300 hover:scale-110 transform" id="menu-toggle">
                ☰
            </button>
        </div>

        <!-- Menu Navigasi -->
        <div id="menu"
            class="hidden lg:flex flex-col lg:flex-row lg:items-center lg:gap-10 w-full lg:w-auto mt-5 lg:mt-0">
            <ul
                class="flex flex-col lg:flex-row items-start lg:items-center gap-4 font-medium text-base w-full lg:w-auto">
                <li>
                    <a href="{{ route('landing') }}"
                        class="{{ request()->is('/') ? 'underline font-bold text-white' : 'text-white' }} relative px-3 py-2 rounded-lg transition-all duration-300 hover:text-yellow-300 hover:bg-white/20 hover:scale-105 transform group">
                        <span class="relative z-10">Beranda</span>
                        <div class="absolute inset-0 bg-yellow-400/20 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 origin-center"></div>
                    </a>
                </li>
                @foreach (\App\Models\NewsCategory::all() as $category)
                    <li>
                        <a href="{{ route('news.category', ['slug' => $category->slug]) }}"
                            class="{{ request()->is($category->slug) ? 'underline font-bold text-white' : 'text-white' }} relative px-3 py-2 rounded-lg transition-all duration-300 hover:text-yellow-300 hover:bg-white/20 hover:scale-105 transform group">
                            <span class="relative z-10">{{ $category->title }}</span>
                            <div class="absolute inset-0 bg-yellow-400/20 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 origin-center"></div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Search dan Login -->
    <div class="hidden lg:flex items-center gap-2 mt-4 lg:mt-0 w-full lg:w-auto relative">
       <form action="{{ route('news.search') }}" method="GET" class="relative w-full lg:w-auto">
           <input type="text" name="q" placeholder="Cari berita..." value="{{ request('q') }}"
               class="border border-orange-200 bg-white text-primary rounded-full px-4 py-2 pl-8 w-full text-sm font-normal lg:w-auto focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400 placeholder-orange-300 transition-all duration-300 hover:border-yellow-500 hover:shadow-lg hover:shadow-yellow-200"
               />
           <!-- Icon Search -->
           <span class="absolute inset-y-0 left-3 flex items-center text-orange-400 transition-transform duration-300 group-hover:scale-110">
               <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4 filter brightness-0 invert">
           </span>
       </form>

        @if(Auth::check())
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="focus:outline-none flex items-center group">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-white bg-white transition-all duration-300 hover:border-yellow-400 hover:scale-110 hover:shadow-lg group-hover:shadow-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="orange" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110 group-hover:stroke-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.5a7.5 7.5 0 0115 0v.75a.75.75 0 01-.75.75h-13.5a.75.75 0 01-.75-.75V19.5z" />
                        </svg>
                    </span>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg z-50 transition-all duration-200 transform origin-top" style="min-width: 160px;">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-primary hover:bg-yellow-100 hover:text-yellow-700 transition-all duration-300 hover:translate-x-1 transform">My Dashboard</a>
                    <form method="GET" action="{{ route('logout') }}">
                        <button type="submit" class="w-full text-left px-4 py-2 text-primary hover:bg-red-100 hover:text-red-700 transition-all duration-300 hover:translate-x-1 transform">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('user.login') }}"
                class="bg-white px-8 py-2 rounded-full text-primary font-semibold h-fit text-sm lg:text-base transition-all duration-300 hover:bg-yellow-400 hover:text-white hover:scale-105 hover:shadow-lg transform hover:shadow-yellow-300">
                Masuk
            </a>
        @endif
    </div>
</div>
