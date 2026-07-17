@extends('layouts.public')

@section('title', 'Portfolio - Mooolagi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="font-display text-3xl font-bold text-meadow-dark text-center mb-2">Portfolio Kami</h1>
    <p class="font-body text-cocoa-dark/70 text-center mb-12">Beberapa karya yang pernah kami wujudkan</p>

    @if ($portfolios->isEmpty())
        <p class="text-center font-body text-cocoa-dark/60">Belum ada portfolio yang ditampilkan.</p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($portfolios as $item)
                <a href="{{ route('portfolio.show', $item) }}"
                   class="group bg-white rounded-2xl border-2 border-sky-light overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="aspect-square bg-sky-light overflow-hidden">
                        <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition">
                    </div>
                    <div class="p-4">
                        @if ($item->category)
                            <span class="text-xs font-display font-semibold text-bubblegum">{{ $item->category->name }}</span>
                        @endif
                        <h3 class="font-display font-semibold text-cocoa-dark mt-1">{{ $item->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-10">{{ $portfolios->links() }}</div>
    @endif
</div>
@endsection