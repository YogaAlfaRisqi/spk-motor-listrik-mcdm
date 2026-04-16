@props([
    'criterias' => collect(),
    'weights'   => [],
])

@php
// 🔥 samakan dengan tabel (INI KUNCI)
$ewData  = collect($weights['ew'] ?? [])->keyBy('id_kriteria');
$rsData  = collect($weights['rs'] ?? [])->keyBy('id_kriteria');
$rrData  = collect($weights['rr'] ?? [])->keyBy('id_kriteria');
$rocData = collect($weights['roc'] ?? [])->keyBy('id_kriteria');

// 🔥 labels
$labels = collect($criterias)
    ->pluck('nama_kriteria')
    ->map(fn($v) => $v ?? '-')
    ->values();

// 🔥 data (WAJIB FLOAT)
$ew = collect($criterias)
    ->map(fn($c) => (float) ($ewData[$c->id_kriteria]['bobot'] ?? 0))
    ->values();

$rs = collect($criterias)
    ->map(fn($c) => (float) ($rsData[$c->id_kriteria]['bobot'] ?? 0))
    ->values();

$rr = collect($criterias)
    ->map(fn($c) => (float) ($rrData[$c->id_kriteria]['bobot'] ?? 0))
    ->values();

$roc = collect($criterias)
    ->map(fn($c) => (float) ($rocData[$c->id_kriteria]['bobot'] ?? 0))
    ->values();
@endphp

<div wire:ignore class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow">

    {{-- DEBUG (hapus kalau sudah fix) --}}
    {{-- <pre>{{ json_encode($ew) }}</pre> --}}

    {{-- DATA --}}
    <div
        id="weightData"
        data-labels='@json($labels)'
        data-ew='@json($ew)'
        data-rs='@json($rs)'
        data-rr='@json($rr)'
        data-roc='@json($roc)'>
    </div>

    {{-- CHART --}}
    <div id="weightChart" style="min-height: 350px;"></div>

</div>