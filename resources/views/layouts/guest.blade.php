<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Mooolagi') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-sky-light min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Mooolagi" class="h-16 w-auto mx-auto">
            </a>
        </div>

        <div class="bg-white rounded-2xl border-3 border-meadow shadow-lg px-8 py-8">
            {{ $slot }}
        </div>

        <p class="text-center text-sm text-cocoa-dark/60 font-body mt-6">
            <a href="{{ route('home') }}" class="hover:text-meadow transition">&larr; Kembali ke Beranda</a>
        </p>
    </div>
</body>
</html>