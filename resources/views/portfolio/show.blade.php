@extends('layouts.public')

@section('title', $portfolio->title . ' - Mooolagi')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-16">
    <a href="{{ route('portfolio.index') }}" class="text-sm font-body text-cocoa-dark/60 hover:text-meadow transition">&larr; Kembali ke Portfolio</a>

    <h1 class="font-display text-3xl font-bold text-meadow-dark mt-4 mb-2">{{ $portfolio->title }}</h1>
    @if ($portfolio->category)
        <span class="text-sm font-display font-semibold text-bubblegum">{{ $portfolio->category->name }}</span>
    @endif

    <div class="pswp-gallery aspect-video bg-sky-light rounded-2xl overflow-hidden mt-6 mb-6">
    <a href="{{ asset('storage/' . $portfolio->cover_image) }}" data-pswp-width="1600" data-pswp-height="900" class="block w-full h-full cursor-zoom-in">
        <img src="{{ asset('storage/' . $portfolio->cover_image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
    </a>
</div>

    @if ($portfolio->description)
        <p class="font-body text-cocoa-dark/80 leading-relaxed mb-8">{{ $portfolio->description }}</p>
    @endif

    @if ($portfolio->gallery_images)
        <div class="pswp-gallery grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($portfolio->gallery_images as $image)
        <a href="{{ asset('storage/' . $image) }}" data-pswp-width="1200" data-pswp-height="1200" class="block cursor-zoom-in">
            <img src="{{ asset('storage/' . $image) }}" class="w-full aspect-square object-cover rounded-xl border-2 border-sky-light">
        </a>
    @endforeach
</div>
    @endif
</div>
@endsection