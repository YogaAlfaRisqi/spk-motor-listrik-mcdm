<!-- Modal Backdrop -->
<div id="{{ $id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="{{ $id }}Title" role="dialog" aria-modal="true">
    <!-- Overlay -->
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80" onclick="closeModal('{{ $id }}')"></div>

    <!-- Modal Container -->
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="relative inline-block w-full {{ $size }} overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 id="{{ $id }}Title" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Modal Title
                </h3>
                <button type="button" onclick="closeModal('{{ $id }}')" class="text-gray-400 transition hover:text-gray-500 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="{{ $id }}Form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST" id="{{ $id }}Method">
                
                <!-- Modal Body -->
                <div class="px-6 py-4" id="{{ $id }}Body">
                    {{ $slot }}
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900/50">
                    <button type="button" onclick="closeModal('{{ $id }}')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        Batal
                    </button>
                    <button type="submit" id="{{ $id }}SubmitBtn" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        <span id="{{ $id }}SubmitText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>