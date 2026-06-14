<tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03]">
    <td class="px-4 py-4 whitespace-nowrap font-semibold text-gray-800 dark:text-white/90">{{ $criteria->kode_kriteria }}</td>
    <td class="px-4 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ $criteria->nama_kriteria }}</td>
    <td class="px-4 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">{{ $criteria->keterangan }}</td>
    <td class="px-4 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">{{ $criteria->skala_penilaian ?? '-' }}</td>
    <td class="px-4 py-4 whitespace-nowrap">
        <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $criteria->tipe === 'benefit'
                                            ? 'bg-green-100 text-green-600 dark:bg-green-500/15 dark:text-green-400'
                                            : 'bg-red-100 text-red-600 dark:bg-red-500/15 dark:text-red-400' }}">
            {{ ucfirst($criteria->tipe) }}
        </span>
    </td>
    <td class="px-4 py-4 whitespace-nowrap">
        <div class="flex items-center gap-3">
            <button
                type="button"
                class="btn-edit p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-500/10 text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition"
                data-id="{{ $criteria->id_kriteria }}"
                data-kode="{{ $criteria->kode_kriteria }}"
                data-nama="{{ $criteria->nama_kriteria }}"
                data-keterangan="{{ $criteria->keterangan }}"
                data-satuan="{{ $criteria->skala_penilaian }}"
                data-tipe="{{ $criteria->tipe }}"
                data-update-url="{{ route('admin.criteria.update', $criteria->id_kriteria) }}">✎</button>

            <button
                type="button"
                class="btn-delete p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition"
                data-id="{{ $criteria->id_kriteria }}"
                data-name="{{ $criteria->nama_kriteria }}"
                data-delete-url="{{ route('admin.criteria.destroy', $criteria->id_kriteria) }}">🗑</button>
        </div>
    </td>
</tr>