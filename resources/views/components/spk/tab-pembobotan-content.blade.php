<div id="content-{{ $keyTab }}" class="tab-content hidden">

    {{-- Header Tab --}}
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-white">
            {{ $tab['title'] ?? '' }}
        </h4>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ $tab['desc'] ?? '' }}
        </p>
    </div>

    {{-- Formula Box --}}
    <x-spk.formula-box
        :formula="$tab['formula'] ?? ''"
        :color="$tab['color'] ?? 'blue'"
        :desc="$tab['desc'] ?? ''" />

    {{-- Tabel Bobot --}}
    <x-spk.table-bobot
        :criterias="$criterias"
        :weights="$weights"
        :showReciprocal="$keyTab === 'rr'"
        :showSumTerm="$keyTab === 'roc'" />

</div>