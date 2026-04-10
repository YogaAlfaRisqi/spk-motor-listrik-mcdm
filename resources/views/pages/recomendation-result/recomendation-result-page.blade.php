@extends('layouts.app')
@section('content')
<x-common.page-breadcrumb pageTitle="Data Hasil Perangkingan" />
<!-- table content -->
<div class="space-y-6">
    <!-- TABS SECTION -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex px-5 sm:px-6" aria-label="Tabs">

                <button onclick="switchTab('ew')"
                    id="tab-ew"
                    class="tab-button active px-6 py-4 text-sm font-medium border-b-2 transition-colors">
                    Equal Weight (EW)
                </button>
                <button onclick="switchTab('rs')"
                    id="tab-rs"
                    class="tab-button px-6 py-4 text-sm font-medium border-b-2 transition-colors">
                    Rank Sum (RS)
                </button>
                <button onclick="switchTab('rr')"
                    id="tab-rr"
                    class="tab-button px-6 py-4 text-sm font-medium border-b-2 transition-colors">
                    Rank Reciprocal (RR)
                </button>
                <button onclick="switchTab('roc')"
                    id="tab-roc"
                    class="tab-button px-6 py-4 text-sm font-medium border-b-2 transition-colors">
                    ROC
                </button>

                <button onclick="switchTab('pb')"
                    id="tab-pb"
                    class="tab-button px-6 py-4 text-sm font-medium border-b-2 transition-colors">
                    Perbandingan Ranking
                </button>

            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-5 sm:p-6">
            <!-- EW Content -->
            <div id="content-ew" class="tab-content">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Metode Equal Weight (EW)
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Metode Equal Weight memberikan bobot yang sama untuk setiap kriteria.
                </p>

                <!-- ===================== -->
                <!-- 1. TABEL ALTERNATIF -->
                <!-- ===================== -->
                <h5 class="font-semibold mb-2">Tabel Alternatif</h5>
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full border">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-3 py-2">Motor</th>
                                @foreach($criterias as $k)
                                <th class="px-3 py-2">{{ $k->kode_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>

                    </table>
                </div>

                <!-- Calculation Process -->
                <div class="space-y-4">
                    <h5 class="font-semibold mb-2">Tabel Bobot</h5>
                    <!-- Formula -->
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <h5 class="font-semibold text-gray-800 dark:text-white/90 mb-2">Formula:</h5>
                        <div class="text-sm text-gray-700 dark:text-gray-300 font-mono">
                            w<sub>j</sub> = 1/n
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            Dimana n = jumlah kriteria
                        </p>
                    </div>

                    <!-- Bobot Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kode Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Peringkat</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bobot (W_j)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @php
                                $kriteria = \App\Models\Criteria::orderBy('kode_kriteria')->get();
                                $totalKriteria = $kriteria->count();
                                $bobotEW = $totalKriteria > 0 ? 1 / $totalKriteria : 0;
                                @endphp
                                @foreach($kriteria as $item)
                                <tr>
                                    <!-- No -->
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        {{ $loop->iteration }}
                                    </td>

                                    <!-- Kode -->
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        {{ $item->kode_kriteria }}
                                    </td>

                                    <!-- Nama -->
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        {{ $item->nama_kriteria }}
                                    </td>

                                    <!-- Tipe -->
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        {{ ucfirst($item->tipe) }}
                                    </td>

                                    <!-- Peringkat (otomatis dari urutan) -->
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        {{ $loop->iteration }}
                                    </td>

                                    <!-- Bobot -->
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        {{ number_format($bobotEW, 1) }}
                                    </td>
                                </tr>
                                @endforeach
                                <!-- TOTAL -->
                                <tr class="bg-gray-50 dark:bg-gray-800/50 font-semibold">
                                    <td colspan="5" class="px-4 py-3 text-center">
                                        Σ
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ number_format($bobotEW * $totalKriteria, 0) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- RS Content -->
            <div id="content-rs" class="tab-content hidden">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Metode Rank Sum (RS)
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Metode Rank Sum memberikan bobot berdasarkan ranking kriteria.
                </p>

                <!-- Calculation Process -->
                <div class="space-y-4">
                    <!-- Formula -->
                    <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <h5 class="font-semibold text-gray-800 dark:text-white/90 mb-2">Formula:</h5>
                        <div class="text-sm text-gray-700 dark:text-gray-300 font-mono">
                            w<sub>j</sub> = (n - r<sub>j</sub> + 1) / Σ(n - r<sub>k</sub> + 1)
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            Dimana r<sub>j</sub> = ranking kriteria ke-j, n = jumlah kriteria
                        </p>
                    </div>

                    <!-- Calculation Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kode Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Peringkat</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bobot (W_j)</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>

            <!-- RR Content -->
            <div id="content-rr" class="tab-content hidden">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Metode Rank Reciprocal (RR)
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Metode Rank Reciprocal memberikan bobot berbanding terbalik dengan ranking.
                </p>

                <!-- Calculation Process -->
                <div class="space-y-4">
                    <!-- Formula -->
                    <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800">
                        <h5 class="font-semibold text-gray-800 dark:text-white/90 mb-2">Formula:</h5>
                        <div class="text-sm text-gray-700 dark:text-gray-300 font-mono">
                            w<sub>j</sub> = (1/r<sub>j</sub>) / Σ(1/r<sub>k</sub>)
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            Dimana r<sub>j</sub> = ranking kriteria ke-j
                        </p>
                    </div>

                    <!-- Calculation Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kode Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Peringkat</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bobot (W_j)</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>

            <!-- ROC Content -->
            <div id="content-roc" class="tab-content hidden">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Metode Rank Order Centroid (ROC)
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Metode ROC menggunakan pendekatan centroid untuk menentukan bobot kriteria.
                </p>

                <!-- Calculation Process -->
                <div class="space-y-4">
                    <!-- Formula -->
                    <div class="p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                        <h5 class="font-semibold text-gray-800 dark:text-white/90 mb-2">Formula:</h5>
                        <div class="text-sm text-gray-700 dark:text-gray-300 font-mono">
                            w<sub>j</sub> = (1/n) × Σ<sub>k=j</sub><sup>n</sup>(1/k)
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            Dimana n = jumlah kriteria, j = ranking kriteria
                        </p>
                    </div>

                    <!-- Calculation Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kode Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Peringkat</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bobot (W_j)</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Perbandingan Bobot -->
            <div id="content-pb" class="tab-content hidden">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Perbandingan Bobot
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Perbandingan bobot dari 4 buah metode
                </p>

                <!-- Calculation Process -->
                <div class="space-y-4">
                    <!-- Formula -->
                    <div class="p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                        <h5 class="font-semibold text-gray-800 dark:text-white/90 mb-2">Formula:</h5>
                        <div class="text-sm text-gray-700 dark:text-gray-300 font-mono">
                            w<sub>j</sub> = (1/n) × Σ<sub>k=j</sub><sup>n</sup>(1/k)
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            Dimana n = jumlah kriteria, j = ranking kriteria
                        </p>
                    </div>

                    <!-- Calculation Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kode Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Kriteria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Peringkat</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bobot (W_j)</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
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