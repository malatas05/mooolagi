@extends('layouts.public')

@section('title', 'Tentang Kami - Mooolagi')
@section('description', 'Kenali lebih dekat Mooolagi, Creative Gift & Design Studio yang berdedikasi menghadirkan kejutan penuh makna.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-16">
    <div class="text-center mb-12">
        <img src="{{ asset('images/logo.png') }}" alt="Mooolagi" class="h-20 w-auto mx-auto mb-6">
        <h1 class="font-display text-3xl md:text-4xl font-bold text-meadow-dark">Tentang Mooolagi</h1>
    </div>

    <div class="bg-white rounded-2xl border-2 border-sky-light p-8 md:p-10 space-y-6 font-body text-cocoa-dark/80 leading-relaxed">
        <p>
            {{-- TODO: Ganti paragraf ini dengan cerita asli Mooolagi kamu --}}
            Mooolagi adalah Creative Gift & Design Studio yang percaya bahwa setiap hadiah punya cerita untuk disampaikan.
            Kami hadir untuk membantu kamu mewujudkan kejutan yang personal dan penuh makna. mulai dari canva template,
            digital notepad, custom box, hingga kreasi custom blind box yang penuh kejutan.
        </p>
        <p>
            Setiap detail kami kerjakan dengan penuh perhatian, karena bagi kami, momen spesialmu layak dirayakan
            dengan cara yang paling istimewa.
        </p>

        <div class="grid md:grid-cols-3 gap-6 pt-6 border-t border-sky-light">
            <div class="text-center">
                <p class="font-display font-bold text-2xl text-meadow">Canva Template</p>
                <p class="text-sm mt-1">& Digital Notepad</p>
            </div>
            <div class="text-center">
                <p class="font-display font-bold text-2xl text-bubblegum">Custom</p>
                <p class="text-sm mt-1">Design Service</p>
            </div>
            <div class="text-center">
                <p class="font-display font-bold text-2xl text-sky">Photostrip</p>
                <p class="text-sm mt-1">& Study Tracker</p>
            </div>
        </div>

        <div class="pt-6 border-t border-sky-light text-center">
            <p class="font-display font-semibold text-cocoa-dark">Berlokasi di Jakarta, Indonesia</p>
            <a href="{{ route('catalog') }}" class="inline-block mt-4 px-6 py-2.5 rounded-full bg-meadow text-white font-display font-semibold text-sm hover:bg-meadow-dark transition">
                Lihat Katalog Kami
            </a>
        </div>
    </div>
</div>
@endsection