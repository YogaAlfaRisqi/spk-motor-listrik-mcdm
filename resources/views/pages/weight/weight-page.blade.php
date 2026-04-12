@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Data Bobot" />

<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:bg-gray-900">

        {{-- TAB NAV --}}
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex overflow-x-auto px-6" role="tablist">
                @foreach ($menuTabs as $key => $tab)
                    <button
                        onclick="switchTab('{{ $key }}')"
                        id="tab-{{ $key }}"
                        role="tab"
                        aria-controls="content-{{ $key }}"
                        aria-selected="false"
                        class="tab-button flex-shrink-0 px-5 py-4 text-sm font-medium border-b-2 transition-colors duration-150"
                    >
                        {{ $tab['title'] }}
                    </button>
                @endforeach
            </nav>
        </div>

        {{-- TAB CONTENT --}}
        <div class="p-6">
            @foreach ($menuTabs as $key => $tab)
                <x-spk.tab-pembobotan-content
                    :keyTab="$key"
                    :tab="$tab"
                    :criterias="$criterias"
                    :weights="$weights[$key] ?? collect()" />
            @endforeach
        </div>

    </div>
</div>

<script>
    function switchTab(tabName) {
        // Sembunyikan semua konten tab
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));

        // Reset semua tombol tab ke state non-aktif
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-blue-500', 'text-blue-600', 'dark:border-blue-400', 'dark:text-blue-400');
            btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
            btn.setAttribute('aria-selected', 'false');
        });

        // Tampilkan konten tab yang dipilih
        const content = document.getElementById('content-' + tabName);
        if (content) content.classList.remove('hidden');

        // Aktifkan tombol tab yang dipilih
        const activeBtn = document.getElementById('tab-' + tabName);
        if (activeBtn) {
            activeBtn.classList.add('border-blue-500', 'text-blue-600', 'dark:border-blue-400', 'dark:text-blue-400');
            activeBtn.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
            activeBtn.setAttribute('aria-selected', 'true');
        }
    }

    // Aktifkan tab pertama saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => switchTab('ew'));
</script>
@endsection