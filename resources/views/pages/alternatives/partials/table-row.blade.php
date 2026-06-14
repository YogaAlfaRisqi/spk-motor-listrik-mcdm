<tr>
    <!-- NAMA -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->nama_motor }}
        </div>
    </td>

    <!-- KETERANGAN -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->harga }}
        </div>
    </td>

    <!-- SATUAN -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->jarak_tempuh }}
        </div>
    </td>

    <!-- KODE -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->waktu_pengisian }}
        </div>
    </td>

    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->kapasitas_baterai }}
        </div>
    </td>

    <!-- KODE -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->daya_maksimum }}
        </div>
    </td>

    <!-- Gambar -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            @if ($alternative->gambar)
                <img src="{{ asset('storage/' . $alternative->gambar) }}" alt="{{ $alternative->nama_motor }}" class="w-16 h-auto rounded">
            @else
                <span class="text-gray-400 italic">No Image</span>
            @endif
        </div>
    </td>

    <!-- KODE -->
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            {{ $alternative->user->name }}
        </div>
    </td>

    <!-- ACTION -->
    <td class="px-4 py-4 text-center whitespace-nowrap">
        <div class="flex justify-center gap-3">

            <!-- EDIT -->
            <button type="button" class="btn-edit p-2 rounded-lg hover:bg-blue-50 text-blue-500 hover:text-blue-700 transition"
                data-id="{{ $alternative->id }}"
                data-nama="{{ $alternative->nama_motor }}"
                data-harga="{{ $alternative->harga }}"
                data-jarak-tempuh="{{ $alternative->jarak_tempuh }}"
                data-waktu-pengisian="{{ $alternative->waktu_pengisian }}"
                data-kapasitas-baterai="{{ $alternative->kapasitas_baterai }}"
                data-daya-maksimum="{{ $alternative->daya_maksimum }}"
                data-update-url="{{ route('admin.alternatives.update', $alternative->id_motor) }}">

                <!-- Pencil Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5h2m-1-1v2m-6 9l9-9 3 3-9 9H5v-3z" />
                </svg>
            </button>

            <!-- DELETE -->
            <button type="button" class="btn-delete p-2 rounded-lg hover:bg-red-50 text-red-500 hover:text-red-700 transition"
                data-name="{{ $alternative->nama_motor }}"
                data-delete-url="{{ route('admin.alternatives.destroy', $alternative->id_motor) }}">

                <!-- Trash Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 7h12M9 7V4h6v3m-7 4v6m4-6v6m4-6v6M5 7h14l-1 14H6L5 7z" />
                </svg>
            </button>

        </div>
    </td>
</tr>