@extends('layouts.public')

@section('structured_data')
<script type="application/ld+json">
{!! $organizationSchema !!}
</script>
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-sky-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-block bg-white text-meadow font-display font-semibold text-sm px-4 py-1.5 rounded-full shadow-sm mb-5">
                Creative Gift & Design Studio
            </span>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-meadow-dark leading-tight">
                Setiap kado punya cerita, kami bantu bikin kejutannya.
            </h1>
            <p class="font-body text-cocoa-dark/80 mt-5 text-lg">
                canva template, digital notepad, custom box, hingga kreasi custom blind box yang penuh kejutan.
                dibuat khusus untuk momen spesial kamu.
            </p>
            <div class="flex flex-wrap gap-4 mt-8">
                <a href="#kategori" class="px-7 py-3.5 rounded-full bg-meadow text-white font-display font-semibold shadow-lg hover:bg-meadow-dark transition">
                    Lihat Katalog
                </a>
                <a href="{{ route('about') }}" class="px-7 py-3.5 rounded-full border-2 border-bubblegum text-bubblegum font-display font-semibold hover:bg-bubblegum hover:text-white transition">
    Lihat Tentang Kami
</a>
            </div>
        </div>

        <div x-data="{ opened: false }" x-init="setTimeout(() => opened = true, 500)" class="relative h-80 flex items-center justify-center">
            <svg class="absolute top-2 left-4 w-8 h-8 text-sunshine animate-bounce" style="animation-duration:2s" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0l2.5 6.5L19 9l-6.5 2.5L10 18l-2.5-6.5L1 9l6.5-2.5L10 0z"/>
            </svg>
            <svg class="absolute bottom-8 right-6 w-6 h-6 text-sky animate-bounce" style="animation-duration:2.5s" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0l2.5 6.5L19 9l-6.5 2.5L10 18l-2.5-6.5L1 9l6.5-2.5L10 0z"/>
            </svg>

            <div class="relative w-64 h-56">
                <div class="absolute bottom-0 w-full h-36 bg-sunshine rounded-2xl border-4 border-white shadow-xl"></div>
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-8 h-36 bg-bubblegum"></div>

                <div class="absolute top-14 w-full h-16 bg-meadow rounded-xl border-4 border-white shadow-lg transition-all duration-700 ease-out"
                     :class="opened ? '-translate-y-8 -rotate-6 opacity-90' : ''"></div>

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-12 bg-bubblegum rounded-full border-4 border-white transition-all duration-700"
                     :class="opened ? '-translate-y-14 opacity-0' : ''"></div>
            </div>
        </div>
    </div>
</section>

{{-- KATEGORI --}}
<section id="kategori" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <h2 class="font-display text-3xl font-bold text-meadow-dark text-center mb-2">Layanan Kami</h2>
    <p class="font-body text-cocoa-dark/70 text-center mb-12">Pilih kategori sesuai kebutuhan kejutanmu</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @php $colors = ['meadow', 'sky', 'bubblegum', 'sunshine']; @endphp
        @foreach ($categories as $index => $category)
            <a href="{{ route('catalog', ['kategori' => $category->slug]) }}"
               class="group bg-white rounded-2xl border-3 border-{{ $colors[$index % 4] }} p-6 text-center shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                <div class="w-14 h-14 mx-auto rounded-full bg-{{ $colors[$index % 4] }}/15 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-{{ $colors[$index % 4] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v10H4V12M2 7h20v5H2V7zm10 13V7m0 0a2.5 2.5 0 1 1-2.5-2.5H12v2.5zm0 0a2.5 2.5 0 1 0 2.5-2.5H12v2.5z" />
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-cocoa-dark">{{ $category->name }}</h3>
                <p class="text-xs text-cocoa-dark/60 mt-1">{{ $category->products_count }} produk</p>
            </a>
        @endforeach
    </div>
</section>

{{-- PRODUK UNGGULAN --}}
@if ($featuredProducts->isNotEmpty())
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-3xl font-bold text-meadow-dark text-center mb-2">Produk Pilihan</h2>
            <p class="font-body text-cocoa-dark/70 text-center mb-12">Beberapa karya favorit dari Mooolagi</p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($featuredProducts as $product)
                    <div class="bg-white rounded-2xl border-3 border-sky-light overflow-hidden shadow-sm hover:shadow-lg transition">
                        <div class="aspect-square bg-sky-light flex items-center justify-center overflow-hidden">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                     alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-cocoa-dark/30 text-sm font-body">Belum ada foto</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <span class="text-xs font-display font-semibold text-bubblegum">{{ $product->category->name }}</span>
                            <h3 class="font-display font-semibold text-cocoa-dark mt-1 truncate">{{ $product->name }}
                                @if ($product->price)
    <p class="text-sm font-body font-semibold text-meadow-dark mt-1">{{ $product->formatted_price }}</p>
@endif
                            </h3>
                            <a href="{{ route('products.show', $product) }}" class="inline-block mt-3 text-sm font-display font-semibold text-meadow hover:text-meadow-dark transition">
                                Lihat Detail &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- TESTIMONI --}}
@if ($testimonials->isNotEmpty())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <h2 class="font-display text-3xl font-bold text-meadow-dark text-center mb-12">Kata Mereka</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($testimonials as $testimonial)
                <div class="bg-white rounded-2xl border-3 border-sunshine p-6 shadow-sm">
                    <div class="flex gap-1 text-sunshine mb-3">
                        @for ($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 0l2.5 6.5L19 9l-6.5 2.5L10 18l-2.5-6.5L1 9l6.5-2.5L10 0z"/></svg>
                        @endfor
                    </div>
                    <p class="font-body text-cocoa-dark/80 text-sm">&ldquo;{{ $testimonial->content }}&rdquo;</p>
                    <p class="font-display font-semibold text-cocoa-dark mt-4">{{ $testimonial->customer_name }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endif

{{-- CTA BANNER --}}
<section class="bg-bubblegum">
    <div class="max-w-4xl mx-auto px-4 py-16 text-center">
        <h2 class="font-display text-3xl font-bold text-white mb-4">Masih bingung memilih hadiah?</h2>
        <p class="font-body text-white/90 mb-8">Temukan berbagai pilihan hadiah unik yang siap membuat momen spesial semakin berkesan.</p>
        <a href="{{ route('catalog') }}" class="inline-block px-8 py-3.5 rounded-full bg-white text-bubblegum font-display font-semibold shadow-lg hover:bg-cloud transition">
    Ayo Lihat Produk Kami Sekarang!
</a>
    </div>
</section>

@endsection