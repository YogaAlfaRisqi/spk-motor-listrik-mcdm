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
            --glass: rgba(255, 255, 255, 0.04);
            --border: rgba(255, 255, 255, 0.08);
            --text: #E8EDF2;
            --text-soft: #A8B4C0;
            --radius: 20px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: radial-gradient(circle at top, #111418 0%, #0A0C0F 60%);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Syne', sans-serif;
            letter-spacing: -0.5px;
        }

        /* Container biar rapi */
        .container-modern {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Glass Card */
        .glass {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        /* Glow Accent */
        .glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--lime) 0%, transparent 70%);
            filter: blur(120px);
            opacity: 0.15;
            z-index: -1;
        }

        .glow-top {
            top: -100px;
            left: -100px;
        }

        .glow-bottom {
            bottom: -100px;
            right: -100px;
        }

        /* Page animation */
        .page-content {
            animation: fadeIn 0.5s ease forwards;
            padding: 40px 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar modern */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--lime);
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- Livewire Navbar --}}
    @livewire('navbar')

    <main class="pt-auto py-auto max-w-(--breakpoint-2xl) mx-auto">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Livewire Scripts --}}
    @livewireScripts

    @stack('scripts')
</body>

</html>