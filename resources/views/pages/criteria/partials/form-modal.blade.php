<div id="criteriaModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-2xl rounded-2xl bg-white shadow-xl dark:bg-gray-900">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <h3 id="criteriaModalTitle" class="text-lg font-semibold text-gray-800 dark:text-white">
                Tambah Kriteria
            </h3>
            <button type="button" id="closeCriteriaModal"
                class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">✕</button>
        </div>

        <form id="criteriaForm" method="POST" action="{{ route('admin.criteria.store') }}" class="px-6 py-5">
            @csrf
            {{-- Satu field _method saja, dikontrol JS. JANGAN pakai @method() --}}
            <input type="hidden" name="_method" id="criteriaMethod" value="POST">
            <input type="hidden" id="criteriaId">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Kriteria</label>
                    <input id="kode_kriteria" name="kode_kriteria" type="text"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-400 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kriteria</label>
                    <input id="nama_kriteria" name="nama_kriteria" type="text"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-400 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-400 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Satuan</label>
                    <input id="skala_penilaian" name="skala_penilaian" type="text"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-400 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe</label>
                    <select id="tipe" name="tipe"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-400 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <option value="">Pilih tipe</option>
                        <option value="cost">Cost</option>
                        <option value="benefit">Benefit</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" id="cancelCriteriaModal"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>