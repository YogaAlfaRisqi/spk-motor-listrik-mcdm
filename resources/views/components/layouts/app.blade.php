<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK-MCDM - Sistem Rekomendasi Motor Listrik</title>
    <meta name="description" content="Temukan motor listrik terbaik untuk Anda menggunakan sistem pendukung keputusan berbasis MCDM">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    @vite(['resources/css/public.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- @stack('styles') -->
</head>

<body>
    @livewire('navbar')

    <main class="pt-auto py-auto max-w-(--breakpoint-2xl) mx-auto">
        {{ $slot }}
    </main>

    @include('layouts.footer')

    @livewireScripts

    @stack('scripts')
</body>

</html>