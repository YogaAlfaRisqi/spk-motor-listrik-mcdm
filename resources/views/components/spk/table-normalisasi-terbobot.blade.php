@props(['data' => []])

@php
    // 🔥 ambil kolom dengan aman
    $columns = !empty($data) && isset($data[0]['values'])
        ? array_keys($data[0]['values'])
        : [];
@endphp

<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden table-auto">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="px-4 py-3 text-sm font-semibold">No</th>
                <th class="px-4 py-3 text-sm font-semibold">Nama Motor</th>

                @foreach($columns as $i => $col)
                    <th class="px-4 py-3 text-sm text-center font-semibold">
                        V{{ $i + 1 }}
                    </th>
                @endforeach
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody>
            @forelse($data as $row)
                <tr>
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>

                    <td class="px-4 py-3 font-medium">
                        {{ $row['nama_motor'] ?? '-' }}
                    </td>

                    @foreach(($row['values'] ?? []) as $val)
                        <td class="px-4 py-3 text-center">
                            {{ number_format((float) $val, 10, '.', '') }}
                        </td>
                    @endforeach

                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 2 }}" class="text-center py-6">
                        Data tidak tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>