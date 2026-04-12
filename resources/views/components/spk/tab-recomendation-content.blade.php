<div id="content-{{ $keyTab }}" class="tab-content hidden">

    {{-- HEADER --}}
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-white">
            {{ $tab['title'] }}
        </h4>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $tab['desc'] }}
        </p>
    </div>

    {{-- ACCORDION --}}
    <div x-data="{ open: 1, allOpen: false }" class="space-y-3">

        {{-- CONTROL BUTTON --}}
        <div class="flex justify-end gap-2 mb-2">
            <button
                @click="allOpen = true"
                class="px-3 py-1 text-xs bg-green-500 text-white rounded hover:bg-green-600 transition">
                Open All
            </button>

            <button
                @click="allOpen = false; open = null"
                class="px-3 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Close All
            </button>
        </div>

        {{-- STEP 1 --}}
        <div class="border rounded-xl dark:border-gray-700">
            <button @click="open = open === 1 ? null : 1"
                class="w-full flex justify-between items-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-200">
                <span>1. Tabel Alternatif</span>
                <span x-text="(open === 1 || allOpen) ? '-' : '+'"></span>
            </button>

            <div x-show="open === 1 || allOpen"
                x-transition.duration.300ms
                class="p-4 border-t dark:border-gray-700">

                <x-spk.table-alternatif
                    :alternatives="$alternatives"
                    :columns="$columns" />
            </div>
        </div>

        {{-- STEP 2 --}}
        <div class="border rounded-xl dark:border-gray-700">
            <button @click="open = open === 2 ? null : 2"
                class="w-full flex justify-between items-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-200">
                <span>2. Tabel Bobot</span>
                <span x-text="(open === 2 || allOpen) ? '-' : '+'"></span>
            </button>

            <div x-show="open === 2 || allOpen"
                x-transition.duration.300ms
                class="p-4 border-t dark:border-gray-700">

                <x-spk.table-bobot
                    :criterias="$criterias"
                    :weights="$weights"
                    :showReciprocal="$keyTab === 'rr'"
                    :showSumTerm="$keyTab === 'roc'" />
            </div>
        </div>
    </div>

    {{-- STEP 3 --}}
    <div class="border rounded-xl dark:border-gray-700">
        <button @click="open = open === 3 ? null : 3"
            class="w-full flex justify-between items-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-200">
            <span>3. Normalisasi</span>
            <span x-text="(open === 3 || allOpen) ? '-' : '+'"></span>
        </button>

        <div x-show="open === 3 || allOpen"
            x-transition.duration.300ms
            class="p-4 border-t dark:border-gray-700">

            <x-spk.table-normalisasi
                :alternatives="$alternatives"
                :columns="$columns" />
        </div>
    </div>

    {{-- STEP 4 --}}
    <div class="border rounded-xl dark:border-gray-700">
        <button @click="open = open === 4 ? null : 4"
            class="w-full flex justify-between items-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-200">
            <span>4. Normalisasi Terbobot</span>
            <span x-text="(open === 4 || allOpen) ? '-' : '+'"></span>
        </button>

        <div x-show="open === 4 || allOpen"
            x-transition.duration.300ms
            class="p-4 border-t dark:border-gray-700">

            <x-spk.table-normalisasi-terbobot
                :alternatives="$alternatives"
                :columns="$columns" />
        </div>
    </div>

    {{-- STEP 5 --}}
    <div class="border rounded-xl dark:border-gray-700">
        <button @click="open = open === 5 ? null : 5"
            class="w-full flex justify-between items-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-200">
            <span>5. Solusi Ideal</span>
            <span x-text="(open === 5 || allOpen) ? '-' : '+'"></span>
        </button>

        <div x-show="open === 5 || allOpen"
            x-transition.duration.300ms
            class="p-4 border-t dark:border-gray-700">

            <x-spk.table-solusi-ideal
                :alternatives="$alternatives"
                :columns="$columns" />
        </div>
    </div>

    {{-- STEP 6 --}}
    <div class="border rounded-xl dark:border-gray-700">
        <button @click="open = open === 6 ? null : 6"
            class="w-full flex justify-between items-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-200">
            <span>6. Jarak & Ranking</span>
            <span x-text="(open === 6 || allOpen) ? '-' : '+'"></span>
        </button>

        <div x-show="open === 6 || allOpen"
            x-transition.duration.300ms
            class="p-4 border-t dark:border-gray-700">

            <x-spk.table-rumus-jarak
                :alternatives="$alternatives"
                :columns="$columns" />
        </div>
    </div>

</div>
</div>