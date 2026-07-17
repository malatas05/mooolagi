<header class="bg-white/80 backdrop-blur-sm sticky top-0 z-50 border-b border-sky-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Mooolagi" class="h-12 w-auto">
            </a>

            <nav class="hidden md:flex items-center gap-8 font-display font-medium text-cocoa">
                <a href="{{ route('catalog') }}" class="hover:text-meadow transition">Katalog</a>
                <a href="{{ route('portfolio.index') }}" class="hover:text-meadow transition">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="hover:text-meadow transition">Blog</a>
                <a href="{{ route('about') }}" class="hover:text-meadow transition">Tentang</a>
            </nav>

            <div class="hidden md:flex items-center gap-3">
    @auth
        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-full border-2 border-meadow text-meadow font-display font-semibold text-sm hover:bg-meadow hover:text-white transition">
            Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-5 py-2.5 rounded-full bg-bubblegum text-white font-display font-semibold text-sm hover:opacity-90 transition">
                Keluar
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full border-2 border-meadow text-meadow font-display font-semibold text-sm hover:bg-meadow hover:text-white transition">
            Masuk
        </a>
        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full bg-meadow text-white font-display font-semibold text-sm hover:bg-meadow-dark transition">
            Daftar
        </a>
    @endauth
</div>

            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="p-2" aria-label="Buka menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-meadow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div x-show="open" x-cloak @click.outside="open = false"
     class="absolute top-20 left-0 right-0 bg-white shadow-lg border-t border-sky-light px-6 py-4 flex flex-col gap-4 font-display font-medium text-cocoa">
    <a href="{{ route('catalog') }}">Katalog</a>
    <a href="{{ route('portfolio.index') }}">Portfolio</a>
    <a href="{{ route('blog.index') }}">Blog</a>
    <a href="{{ route('about') }}">Tentang</a>
    @auth
        <a href="{{ route('dashboard') }}" class="font-semibold text-meadow">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="font-semibold text-bubblegum text-left">Keluar</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="font-semibold text-meadow">Masuk</a>
        <a href="{{ route('register') }}" class="font-semibold text-bubblegum">Daftar</a>
    @endauth
</div>
    </div>
</header>