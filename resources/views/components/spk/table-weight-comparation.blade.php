@props([
    'criterias' => collect(),
    'weights'   => [],
])

@php
    $ew  = collect($weights['ew'] ?? [])->keyBy('id_kriteria');
    $rs  = collect($weights['rs'] ?? [])->keyBy('id_kriteria');
    $rr  = collect($weights['rr'] ?? [])->keyBy('id_kriteria');
    $roc = collect($weights['roc'] ?? [])->keyBy('id_kriteria');
@endphp

<div class="overflow-x-auto py-4">
    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden text-sm">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800/50 text-gray-600 dark:text-gray-300">
            <tr>
                <th rowspan="2" class="px-4 py-3 w-12 text-center">No</th>
                <th rowspan="2" class="px-4 py-3 w-24 text-left">Kode</th>
                <th rowspan="2" class="px-4 py-3 text-left">Nama Kriteria</th>
                <th colspan="4" class="px-4 py-3 text-center font-semibold">
                    Bobot
                </th>
            </tr>
            <tr>
                <th class="px-4 py-2 text-center w-24">EW</th>
                <th class="px-4 py-2 text-center w-24">RS</th>
                <th class="px-4 py-2 text-center w-24">RR</th>
                <th class="px-4 py-2 text-center w-24">ROC</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($criterias as $c)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                    <td class="px-4 py-3 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold">
                        {{ $c->kode_kriteria }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $c->nama_kriteria }}
                    </td>

                    {{-- ANGKA WAJIB: text-right + tabular-nums --}}
                    <td class="px-4 py-3 text-right tabular-nums text-blue-600">
                        {{ isset($ew[$c->id_kriteria]) ? number_format((float)$ew[$c->id_kriteria]['bobot'], 6, '.', '') : '-' }}
                    </td>

                    <td class="px-4 py-3 text-right tabular-nums text-green-600">
                        {{ isset($rs[$c->id_kriteria]) ? number_format((float)$rs[$c->id_kriteria]['bobot'], 6, '.', '') : '-' }}
                    </td>

                    <td class="px-4 py-3 text-right tabular-nums text-purple-600">
                        {{ isset($rr[$c->id_kriteria]) ? number_format((float)$rr[$c->id_kriteria]['bobot'], 6, '.', '') : '-' }}
                    </td>

                    <td class="px-4 py-3 text-right tabular-nums text-orange-600">
                        {{ isset($roc[$c->id_kriteria]) ? number_format((float)$roc[$c->id_kriteria]['bobot'], 6, '.', '') : '-' }}
                    </td>

                </tr>
            @endforeach
        </tbody>

        {{-- FOOTER --}}
        <tfoot class="bg-yellow-50 dark:bg-yellow-900/20 font-semibold">
            <tr>
                <td colspan="3" class="text-right px-4 py-3">
                    Total
                </td>

                <td class="px-4 py-3 text-right tabular-nums">
                    {{ number_format((float)collect($weights['ew'] ?? [])->sum('bobot'), 6, '.', '') }}
                </td>

                <td class="px-4 py-3 text-right tabular-nums">
                    {{ number_format((float)collect($weights['rs'] ?? [])->sum('bobot'), 6, '.', '') }}
                </td>

                <td class="px-4 py-3 text-right tabular-nums">
                    {{ number_format((float)collect($weights['rr'] ?? [])->sum('bobot'), 6, '.', '') }}
                </td>

                <td class="px-4 py-3 text-right tabular-nums">
                    {{ number_format((float)collect($weights['roc'] ?? [])->sum('bobot'), 6, '.', '') }}
                </td>
            </tr>
        </tfoot>

    </table>
</div>