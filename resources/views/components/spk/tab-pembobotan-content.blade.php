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
    @if($keyTab !== 'compare')
    <x-spk.formula-box
        :formula="$tab['formula'] ?? ''"
        :color="$tab['color'] ?? 'blue'"
        :desc="$tab['desc'] ?? ''" />
    @endif

    {{-- TABLE --}}
    @if($keyTab === 'compare')
        <x-spk.table-weight-comparation
            :criterias="$criterias"
            :weights="$weights"
        />
    @else
        <x-spk.table-bobot
            :criterias="$criterias"
            :weights="$weights"
            :showReciprocal="$keyTab === 'rr'"
            :showSumTerm="$keyTab === 'roc'"
        />
    @endif

</div>