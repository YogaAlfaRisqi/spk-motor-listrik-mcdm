
<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden table-auto">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 w-12">
                    No
                </th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Nama Motor
                </th>

                @foreach($columns as $index => $col)
                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                    C{{ $index + 1 }}
                </th>
                @endforeach
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($alternatives as $a)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                {{-- NOMOR --}}
                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                    {{ $loop->iteration }}
                </td>

                {{-- NAMA --}}
                <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">
                    {{ $a->nama_motor }}
                </td>

                {{-- NORMALISASI --}}
                @foreach($columns as $index => $col)
                @php
                    $criteria = $criterias[$index] ?? null;
                    $tipe = $criteria->tipe ?? 'benefit';
                    $value = $a->$col ?? 0;

                    $norm = 0;

                    if ($tipe === 'benefit') {
                        $norm = ($max[$col] ?? 0) != 0 ? $value / $max[$col] : 0;
                    } else {
                        $norm = $value != 0 ? ($min[$col] ?? 0) / $value : 0;
                    }
                @endphp

                <td class="px-4 py-3 text-sm text-center text-gray-700 dark:text-gray-300">
                    {{ number_format($norm, 3) }}
                </td>
                @endforeach

            </tr>
            @empty
            <tr>
                <td colspan="{{ 2 + count($columns) }}"
                    class="text-center py-6 text-gray-500 dark:text-gray-400">
                    Data tidak tersedia
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>
</div>