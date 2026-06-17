@props(['data' => []])

@php
$labels = collect($data)->pluck('name')->values();
$ew = collect($data)->pluck('ew')->values();
$rs = collect($data)->pluck('rs')->values();
$rr = collect($data)->pluck('rr')->values();
$roc = collect($data)->pluck('roc')->values();

$chartId = uniqid('spk_');
@endphp

<div wire:ignore class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow">

    <!-- <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
        Perbandingan Ranking Alternatif
    </h3> -->

    {{-- DATA --}}
    <div
        id="spk-chart-data-{{ $chartId }}"
        data-labels='@json($labels)'
        data-ew='@json($ew)'
        data-rs='@json($rs)'
        data-rr='@json($rr)'
        data-roc='@json($roc)'>
    </div>

    {{-- CHART --}}
    <div id="chart-line-{{ $chartId }}" style="min-height: 320px;"></div>

</div>