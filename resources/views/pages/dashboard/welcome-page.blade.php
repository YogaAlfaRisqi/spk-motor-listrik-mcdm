@extends('layouts.app')

@section('content')

@php
$cards = [
  [
    'label' => 'Total Kriteria',
    'value' => $totalKriteria ?? 0,
    'icon'  => 'sliders-horizontal',
    'color' => 'blue',
  ],
  [
    'label' => 'Total Alternatif',
    'value' => $totalAlternatif ?? 0,
    'icon'  => 'bike',
    'color' => 'green',
  ],
  [
    'label' => 'Total User',
    'value' => $totalUser ?? 0,
    'icon'  => 'users',
    'color' => 'purple',
  ],
];
@endphp

<div class="min-h-screen bg-gray-50 dark:bg-gray-950 px-4 md:px-6 py-6 space-y-6">

  {{-- ================= HEADER ================= --}}
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 
      p-6 md:p-8 rounded-2xl border border-gray-200/70 dark:border-gray-800 
      bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-950 shadow-sm">
    <div>
      <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
        Dashboard SPK ⚡
      </h1>
      <p class="text-sm md:text-base text-gray-500 dark:text-gray-400">
        Analisis & Rekomendasi Motor Listrik berbasis Surrogate Weighting Procedures dan TOPSIS   
      </p>
    </div>
    <div class="px-4 py-2 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 
        text-white text-sm font-semibold shadow-md">
      Admin {{ Auth::user()->name }}
    </div>

  </div>

  {{-- ================= KPI ================= --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($cards as $card)
      <x-common.statistic-card :card="$card" />
    @endforeach
  </div>

  {{-- ================= MAIN GRID ================= --}}
  <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    {{-- 🔥 WEIGHT CHART --}}
    <div class="p-6 md:p-8 rounded-2xl border border-gray-200/70 dark:border-gray-800 
        bg-white dark:bg-gray-900 shadow-sm">

      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
          Perbandingan Bobot
        </h2>

        <span class="text-xs text-gray-400">Weight Analysis</span>
      </div>

      <div wire:ignore>
        <x-spk.weight-chart
            :criterias="$criterias"
            :weights="$weights"
        />
      </div>
    </div>


    {{-- 🔥 RANKING CHART --}}
    <div class="p-6 md:p-8 rounded-2xl border border-gray-200/70 dark:border-gray-800 
        bg-white dark:bg-gray-900 shadow-sm">

      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
          Perbandingan Ranking Alternatif
        </h2>

        <span class="text-xs text-gray-400">Decision Result</span>
      </div>

      @if(!empty($comparisonData))
        <div wire:ignore>
          <x-spk.chart-ranking :data="$comparisonData" />
        </div>
      @else
        <div class="py-16 text-center text-gray-400 text-sm">
          Belum ada data perbandingan
        </div>
      @endif
    </div>
  </div>
</div>

@endsection