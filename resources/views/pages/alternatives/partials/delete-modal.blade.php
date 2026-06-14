<div id="deleteAlternativeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-md rounded-2xl bg-white shadow-xl dark:bg-gray-900">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Hapus Alternative</h3>
            <button type="button" id="closeDeleteAlternativeModal"
                class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">✕</button>
        </div>

        <div class="px-6 py-5">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Apakah Anda yakin ingin menghapus alternative
                <span id="deleteAlternativeName" class="font-semibold text-gray-800 dark:text-white"></span>?
                Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <form id="deleteAlternativeForm" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" value="DELETE">

            <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <button type="button" id="cancelDeleteAlternativeModal"
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