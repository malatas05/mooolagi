@extends('layouts.public')

@section('title', $product->name . ' - Mooolagi')
@section('description', Str::limit(strip_tags($product->description), 150))
@section('og_image', $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->image_path) : asset('images/logo.png'))

@section('structured_data')
<script type="application/ld+json">
{!! $productSchema !!}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ activeImage: '{{ $product->images->first()->image_path ?? '' }}' }">

    <div class="grid md:grid-cols-2 gap-12">
        <div>
            <div id="product-gallery" class="pswp-gallery aspect-square bg-sky-light rounded-2xl border-2 border-sky-light overflow-hidden mb-4 relative">
                @forelse ($product->images as $image)
                    <a x-show="activeImage === '{{ $image->image_path }}'" x-cloak
                       href="{{ asset('storage/' . $image->image_path) }}"
                       data-pswp-width="1200" data-pswp-height="1200"
                       class="block w-full h-full cursor-zoom-in absolute inset-0">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </a>
                @empty
                    <div class="w-full h-full flex items-center justify-center text-cocoa-dark/30 font-body">Belum ada foto</div>
                @endforelse
            </div>

            @if ($product->images->count() > 1)
                <div class="flex gap-3">
                    @foreach ($product->images as $image)
                        <button @click="activeImage = '{{ $image->image_path }}'"
                                class="w-16 h-16 rounded-lg overflow-hidden border-2 border-sky-light hover:border-meadow transition">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <a href="{{ route('catalog', ['kategori' => $product->category->slug]) }}"
               class="text-sm font-display font-semibold text-bubblegum">
                {{ $product->category->name }}
            </a>
            <h1 class="font-display text-3xl font-bold text-meadow-dark mt-2">{{ $product->name }}</h1>

            @if ($product->price)
                <p class="font-display text-xl font-bold text-bubblegum mt-2">Mulai dari {{ $product->formatted_price }}</p>
            @endif

            <div class="font-body text-cocoa-dark/80 mt-4 leading-relaxed">
                {!! nl2br(e($product->description)) !!}
            </div>

            <div class="mt-8">
                @if ($product->request_type === 'template')
                    <a href="{{ route('requests.create', $product) }}" class="inline-block px-8 py-3.5 rounded-full bg-bubblegum text-white font-display font-semibold shadow-lg hover:opacity-90 transition">
                        Mulai Custom Request
                    </a>
                    <p class="text-xs text-cocoa-dark/60 mt-2 font-body">Produk ini bisa disesuaikan detailnya sesuai kemauanmu.</p>
                @else
                    <a href="{{ route('requests.create', $product) }}" class="inline-block px-8 py-3.5 rounded-full bg-meadow text-white font-display font-semibold shadow-lg hover:bg-meadow-dark transition">
                        Pesan Sekarang
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection