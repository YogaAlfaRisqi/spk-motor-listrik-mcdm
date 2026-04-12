@extends('layouts.app')
@section('content')
<x-common.page-breadcrumb pageTitle="Data Hasil Perangkingan" />
<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200  bg-white dark:bg-gray-900">

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
                    class="tab-button flex-shrink-0 px-5 py-4 text-sm font-medium border-b-2 transition-colors duration-150">
                    {{ $tab['title'] }}
                </button>
                @endforeach
            </nav>
        </div>

        {{-- TAB CONTENT --}}
        <div class="p-6">
            @foreach($menuTabs as $key => $tab)
            <x-spk.tab-recomendation-content
                :keyTab="$key"
                :tab="$tab"
                :alternatives="$alternatives"
                :columns="$columns"
                :criterias="$criterias"
                :weights="$weights[$key] ?? collect()" />
            @endforeach
        </div>

    </div>
</div>

<script>
    function switchTab(tabName) {
        // Hide all tab contents
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tabs
        const tabs = document.querySelectorAll('.tab-button');
        tabs.forEach(tab => {
            tab.classList.remove('active', 'border-blue-500', 'text-blue-600', 'dark:border-blue-400', 'dark:text-blue-400');
            tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
        });

        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');

        // Add active class to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.classList.add('active', 'border-blue-500', 'text-blue-600', 'dark:border-blue-400', 'dark:text-blue-400');
        activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
    }

    // Initialize first tab as active
    document.addEventListener('DOMContentLoaded', function() {
        switchTab('ew');
    });
</script>

<style>
    .tab-button {
        cursor: pointer;
        white-space: nowrap;
    }

    .tab-button:not(.active) {
        border-color: transparent;
        color: rgb(107 114 128);
    }

    .tab-button.active {
        border-color: rgb(59 130 246);
        color: rgb(37 99 235);
    }

    @media (prefers-color-scheme: dark) {
        .tab-button:not(.active) {
            color: rgb(156 163 175);
        }

        .tab-button.active {
            border-color: rgb(96 165 250);
            color: rgb(96 165 250);
        }
    }
</style>
@endsection