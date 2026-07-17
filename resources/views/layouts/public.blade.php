<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mooolagi - Creative Gift & Design Studio')</title>
    <meta name="description" content="@yield('description', 'Hampers, gift box, custom gift, merchandise, souvenir, design service, dan packaging premium untuk momen spesial kamu.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Mooolagi">
    <meta property="og:title" content="@yield('title', 'Mooolagi - Creative Gift & Design Studio')">
    <meta property="og:description" content="@yield('description', 'Hampers, gift box, custom gift, merchandise, souvenir, design service, dan packaging premium untuk momen spesial kamu.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    @yield('structured_data')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-body bg-cloud text-cocoa-dark antialiased">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @livewireScripts
</body>
</html>