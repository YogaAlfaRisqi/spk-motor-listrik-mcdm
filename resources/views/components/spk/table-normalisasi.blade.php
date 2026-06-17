@props(['data'])

<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="px-4 py-3 text-sm font-semibold text-left">No</th>
                <th class="px-4 py-3 text-sm font-semibold text-left">Nama Motor</th>

                @if(!empty($data))
                    @foreach(array_keys($data[0]['values']) as $index => $col)
                        <th class="px-4 py-3 text-sm text-center font-semibold">
                            C{{ $index + 1 }}
                        </th>
                    @endforeach
                @endif
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="bg-white dark:bg-gray-900 divide-y">

            @forelse($data as $row)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                <td class="px-4 py-3 text-sm">
                    {{ $loop->iteration }}
                </td>

                <td class="px-4 py-3 text-sm font-medium">
                    {{ $row['nama_motor'] }}
                </td>

                @foreach($row['values'] as $val)
                <td class="px-4 py-3 text-sm text-center">
                    {{ number_format($val, 11) }}
                </td>
                @endforeach

            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center py-6 text-gray-500">
                    Data tidak tersedia
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>  