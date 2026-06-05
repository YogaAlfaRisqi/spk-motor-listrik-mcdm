<div class="flex flex-col gap-2 px-5 mb-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
    <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Latest Criteria</h3>
    </div>

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
        <form method="GET" action="{{ route('admin.criteria.index') }}">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search..."
                    class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-blue-800 xl:w-[300px]" />
            </div>
        </form>

        <button type="button" id="btnAddCriteria"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </button>
    </div>
</div>