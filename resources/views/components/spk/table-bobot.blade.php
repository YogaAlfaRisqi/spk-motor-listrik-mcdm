@props([
    'criterias'      => collect(),
    'weights'        => collect(),
    'showReciprocal' => false,
    'showSumTerm'    => false,
])

@php
    $colCount    = 5
                 + ($showReciprocal ? 1 : 0)
                 + ($showSumTerm    ? 2 : 0);
    $colspanLeft = $colCount;
    $colCount   += 1;
@endphp

<div class="overflow-x-auto py-4">
    <table class="min-w-full overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800/50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kode</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400">Peringkat</th>

                @if ($showReciprocal)
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400">
                        Nilai Reciprocal (1/r<sub>j</sub>)
                    </th>
                @endif

                @if ($showSumTerm)
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400">1/k</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400">
                        Σ<sub>k=r<sub>j</sub></sub><sup>n</sup>(1/k)
                    </th>
                @endif

                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400">
                    Bobot (W<sub>j</sub>)
                </th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
            @forelse ($criterias as $c)
                @php
                    // Lookup via id_kriteria yang di-cast ke string
                    $w = $weights[(string) $c->id_kriteria] ?? null;
                @endphp

                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-800/50">

                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 text-sm font-bold text-gray-900 dark:text-gray-100">
                        {{ $c->kode_kriteria }}
                    </td>

                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                        {{ $c->nama_kriteria }}
                    </td>

                    <td class="px-4 py-3 text-sm">
                        @if ($c->tipe === 'cost')
                            <span class="rounded px-2 py-1 text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                Cost
                            </span>
                        @else
                            <span class="rounded px-2 py-1 text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                Benefit
                            </span>
                        @endif
                    </td>

                    {{-- Peringkat langsung dari Eloquent --}}
                    <td class="px-4 py-3 text-center text-sm font-bold text-blue-600 dark:text-blue-400">
                        {{ $c->peringkat }}
                    </td>

                    {{-- Reciprocal (RR) --}}
                    @if ($showReciprocal)
                        <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-gray-100">
                            {{ $w ? number_format((float) $w['reciprocal'], 10) : '-' }}
                        </td>
                    @endif

                    {{-- 1/k dan Σ(1/k) (ROC) --}}
                    @if ($showSumTerm)
                        <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-gray-100">
                            {{ $c->peringkat > 0 ? number_format(1 / $c->peringkat, 10) : '-' }}
                        </td>
                        <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-gray-100">
                            {{ $w ? number_format((float) $w['sum_term'], 10) : '-' }}
                        </td>
                    @endif

                    {{-- Bobot --}}
                    <td class="px-4 py-3 text-center text-sm font-bold text-green-600 dark:text-green-400">
                        {{ $w ? number_format((float) $w['bobot'], 10) : '-' }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="{{ $colCount }}" class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        Data kriteria tidak tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>

        {{-- FOOTER --}}
        <tfoot class="bg-yellow-50 dark:bg-yellow-900/20">
            <tr>
                <td colspan="{{ $colspanLeft }}"
                    class="px-4 py-3 text-right text-sm font-bold text-gray-700 dark:text-gray-300">
                    Total (Σ)
                </td>
                <td class="px-4 py-3 text-center text-sm font-bold text-green-600 dark:text-green-400">
                    {{ number_format((float) $weights->sum('bobot'), 10) }}
                </td>
            </tr>
        </tfoot>

    </table>
</div>