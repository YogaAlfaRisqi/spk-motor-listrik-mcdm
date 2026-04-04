<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK-MCDM - Sistem Rekomendasi Motor Listrik</title>
    <meta name="description" content="Temukan motor listrik terbaik untuk Anda menggunakan sistem pendukung keputusan berbasis MCDM">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --lime: #C8F135;
            --lime-dark: #a8d020;
            --dark: #0A0C0F;
            --dark-2: #111418;
            --dark-3: #1A1F26;
            --dark-4: #252C36;
            --slate: #2E3742;
            --muted: #6B7A8D;
            --text: #E8EDF2;
            --text-soft: #A8B4C0;
            --white: #FFFFFF;
            --radius: 16px;
            --radius-sm: 8px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Syne', sans-serif;
            line-height: 1.15;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-2);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--lime);
            border-radius: 2px;
        }

        /* Page transitions */
        .page-content {
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Livewire Navbar --}}
    @livewire('navbar')

    {{-- Main Content --}}
    <main class="page-content">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Livewire Scripts --}}
    @livewireScripts

    @stack('scripts')
</body>

</html>