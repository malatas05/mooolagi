@extends('layouts.public')

@section('title', $article->title . ' - Mooolagi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-16">
    <a href="{{ route('blog.index') }}" class="text-sm font-body text-cocoa-dark/60 hover:text-meadow transition">&larr; Kembali ke Blog</a>

    <h1 class="font-display text-3xl font-bold text-meadow-dark mt-4 mb-2">{{ $article->title }}</h1>
    <p class="text-sm font-body text-cocoa-dark/50 mb-6">{{ $article->published_at?->translatedFormat('d F Y') }}</p>

    @if ($article->cover_image)
    <div class="pswp-gallery aspect-video bg-sky-light rounded-2xl overflow-hidden mb-8">
        <a href="{{ asset('storage/' . $article->cover_image) }}" data-pswp-width="1600" data-pswp-height="900" class="block w-full h-full cursor-zoom-in">
            <img src="{{ asset('storage/' . $article->cover_image) }}" class="w-full h-full object-cover">
        </a>
    </div>
@endif

    <div class="prose prose-headings:font-display prose-headings:text-meadow-dark max-w-none font-body text-cocoa-dark">
        {!! $article->content !!}
    </div>
</div>
@endsection