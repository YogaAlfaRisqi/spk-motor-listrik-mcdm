<div id="deleteCriteriaModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-md rounded-2xl bg-white shadow-xl dark:bg-gray-900">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Hapus Kriteria</h3>
            <button type="button" id="closeDeleteCriteriaModal"
                class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">✕</button>
        </div>

        <div class="px-6 py-5">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Apakah Anda yakin ingin menghapus kriteria
                <span id="deleteCriteriaName" class="font-semibold text-gray-800 dark:text-white"></span>?
                Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <form id="deleteCriteriaForm" method="POST" action="">
            @csrf
            {{-- DELETE wajib karena HTML form hanya support GET/POST --}}
            <input type="hidden" name="_method" value="DELETE">

            <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" id="cancelDeleteCriteriaModal"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>