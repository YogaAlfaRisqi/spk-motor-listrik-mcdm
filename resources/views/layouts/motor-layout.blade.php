<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Motor - SPK MCDM' }}</title>

    <meta name="description" content="Sistem Rekomendasi Motor Listrik berbasis MCDM">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:300;400;500&display=swap" rel="stylesheet">

    {{-- Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire --}}
    @livewireStyles

    {{-- Alpine (optional tapi recommended untuk UI modern) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Base Style (disederhanakan untuk dashboard) --}}
    <style>
        :root {
            --lime: #C8F135;
            --dark: #0A0C0F;
            --dark-2: #111418;
            --dark-3: #1A1F26;
            --text: #E8EDF2;
            --muted: #6B7A8D;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--text);
            margin: 0;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        .app-content {
            flex: 1;
            padding: 24px;
        }

        .page-content {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="app-layout">

        <div class="flex-1 flex flex-col">

            {{-- ✅ Navbar khusus motor --}}
            @livewire('navbar')

            {{-- ✅ Content --}}
            <main class="app-content">
                <div class="page-content">
                    {{ $slot }}
                </div>
            </main>

        </div>

    </div>

    {{-- Footer OPTIONAL (biasanya dashboard ga pakai) --}}
    @include('layouts.footer')

    {{-- Livewire --}}
    @livewireScripts

    @stack('scripts')

</body>
</html>