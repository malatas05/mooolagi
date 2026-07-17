@extends('layouts.public')

@section('title', 'Testimoni - Mooolagi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="font-display text-3xl font-bold text-meadow-dark text-center mb-2">Kata Mereka</h1>
    <p class="font-body text-cocoa-dark/70 text-center mb-12">Pengalaman customer yang sudah pernah pesan di Mooolagi</p>

    @if ($testimonials->isEmpty())
        <p class="text-center font-body text-cocoa-dark/60">Belum ada testimoni.</p>
    @else
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($testimonials as $testimonial)
                <div class="bg-white rounded-2xl border-2 border-sunshine p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        @if ($testimonial->customer_photo)
                            <img src="{{ asset('storage/' . $testimonial->customer_photo) }}" class="w-10 h-10 rounded-full object-cover">
                        @endif
                        <p class="font-display font-semibold text-cocoa-dark">{{ $testimonial->customer_name }}</p>
                    </div>
                    <div class="flex gap-1 text-sunshine mb-2">
                        @for ($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 0l2.5 6.5L19 9l-6.5 2.5L10 18l-2.5-6.5L1 9l6.5-2.5L10 0z"/></svg>
                        @endfor
                    </div>
                    <p class="font-body text-cocoa-dark/80 text-sm">&ldquo;{{ $testimonial->content }}&rdquo;</p>
                </div>
            @endforeach
        </div>
        <div class="mt-10">{{ $testimonials->links() }}</div>
    @endif
</div>
@endsection