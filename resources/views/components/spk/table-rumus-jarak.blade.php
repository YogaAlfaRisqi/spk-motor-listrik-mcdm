@props(['data' => []])

<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">No</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Nama Motor</th>
                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">D+</th>
                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">D-</th>
                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">V<sub>i</sub></th>
                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">Perankingan</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">

            @forelse($data as $row)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                {{-- NO --}}
                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                    {{ $loop->iteration }}
                </td>

                {{-- NAMA --}}
                <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-200">
                    {{ $row['nama_motor'] ?? '-' }}
                </td>

                {{-- D+ --}}
                <td class="px-4 py-3 text-center text-sm text-red-600">
                    {{ number_format((float) ($row['d_plus'] ?? 0), 10, '.', '') }}
                </td>

                {{-- D- --}}
                <td class="px-4 py-3 text-center text-sm text-green-600">
                    {{ number_format((float) ($row['d_minus'] ?? 0), 10, '.', '') }}
                </td>

                {{-- Vi --}}
                <td class="px-4 py-3 text-center text-sm font-bold text-blue-600">
                    {{ number_format((float) ($row['score'] ?? 0), 10, '.', '') }}
                </td>

                {{-- RANK --}}
                <td class="px-4 py-3 text-center text-sm font-bold text-purple-600">
                    {{ $row['rank'] ?? '-' }}
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">
                    Data tidak tersedia
                </td>
            </tr>
            @endforelse

        </tbody>

    </table>
</div>