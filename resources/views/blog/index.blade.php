@extends('layouts.public')

@section('title', 'Blog - Mooolagi')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-16">
    <h1 class="font-display text-3xl font-bold text-meadow-dark text-center mb-2">Blog Mooolagi</h1>
    <p class="font-body text-cocoa-dark/70 text-center mb-12">Tips & inspirasi seputar hadiah dan kejutan</p>

    @if ($articles->isEmpty())
        <p class="text-center font-body text-cocoa-dark/60">Belum ada artikel.</p>
    @else
        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($articles as $article)
                <a href="{{ route('blog.show', $article) }}"
                   class="block bg-white rounded-2xl border-2 border-sky-light overflow-hidden shadow-sm hover:shadow-lg transition">
                    @if ($article->cover_image)
                        <div class="aspect-video bg-sky-light overflow-hidden">
                            <img src="{{ asset('storage/' . $article->cover_image) }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <div class="p-5">
                        <p class="text-xs font-body text-cocoa-dark/50">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                        <h2 class="font-display font-semibold text-lg text-cocoa-dark mt-1">{{ $article->title }}</h2>
                        @if ($article->excerpt)
                            <p class="font-body text-sm text-cocoa-dark/70 mt-2">{{ $article->excerpt }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-10">{{ $articles->links() }}</div>
    @endif
</div>
@endsection