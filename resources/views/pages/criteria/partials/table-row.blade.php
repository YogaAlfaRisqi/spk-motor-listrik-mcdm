<tr>
                                <td class="px-4 py-4 whitespace-nowrap font-semibold">{{ $criteria->kode_kriteria }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $criteria->nama_kriteria }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $criteria->keterangan }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $criteria->skala_penilaian ?? '-' }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $criteria->tipe === 'benefit' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ ucfirst($criteria->tipe) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <button
                                            type="button"
                                            class="btn-edit p-2 rounded-lg hover:bg-blue-50 text-blue-500 hover:text-blue-700 transition"
                                            data-id="{{ $criteria->id_kriteria }}"
                                            data-kode="{{ $criteria->kode_kriteria }}"
                                            data-nama="{{ $criteria->nama_kriteria }}"
                                            data-keterangan="{{ $criteria->keterangan }}"
                                            data-satuan="{{ $criteria->skala_penilaian }}"
                                            data-tipe="{{ $criteria->tipe }}"
                                            data-update-url="{{ route('admin.criteria.update', $criteria->id_kriteria) }}"
                                        >✎</button>

                                        <button
                                            type="button"
                                            class="btn-delete p-2 rounded-lg hover:bg-red-50 text-red-500 hover:text-red-700 transition"
                                            data-id="{{ $criteria->id_kriteria }}"
                                            data-name="{{ $criteria->nama_kriteria }}"
                                            data-delete-url="{{ route('admin.criteria.destroy', $criteria->id_kriteria) }}"
                                        >🗑</button>
                                    </div>
                                </td>
                            </tr>