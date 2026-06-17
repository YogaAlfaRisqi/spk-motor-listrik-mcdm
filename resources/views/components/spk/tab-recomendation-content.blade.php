@props([
'keyTab',
'tab',
'alternatives',
'columns',
'criterias',
'method',
'comparisonData'
])

@php
$isCompare = $keyTab === 'compare';
@endphp

<div id="content-{{ $keyTab }}" class="tab-content hidden" x-data="accordionTab()">

    {{-- HEADER --}}
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-white">
            {{ $tab['title'] }}
        </h4>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $tab['desc'] }}
        </p>
    </div>

    {{-- 🔥 COMPARE --}}
    @if($isCompare)
        <x-spk.table-rank-comparation :data="$comparisonData ?? []" />
    @endif

    {{-- ACCORDION --}}
    <div class="{{ $isCompare ? 'hidden' : '' }} space-y-3">

        <div class="flex justify-end gap-2 mb-2">
            <button @click="openAll" class="px-3 py-1 text-xs bg-green-500 text-white rounded">Open All</button>
            <button @click="closeAll" class="px-3 py-1 text-xs bg-gray-500 text-white rounded">Close All</button>
        </div>

        @foreach([
        ['title'=>'1. Tabel Alternatif','type'=>'alt'],
        ['title'=>'2. Tabel Bobot','type'=>'bobot'],
        ['title'=>'3. Normalisasi','type'=>'norm'],
        ['title'=>'4. Normalisasi Terbobot','type'=>'normb'],
        ['title'=>'5. Solusi Ideal','type'=>'ideal'],
        ['title'=>'6. Jarak & Ranking','type'=>'rank'],
        ] as $i => $step)

        <div class="border rounded-xl dark:border-gray-700">
            <button @click="toggle({{ $i }})" class="w-full flex justify-between px-4 py-3 font-semibold">
                <span class="text-gray-800 dark:text-white">{{ $step['title'] }}</span>
                <span x-text="isOpen({{ $i }}) ? '-' : '+'"></span>
            </button>

            <div x-show="isOpen({{ $i }})" class="p-4 border-t">

                @switch($step['type'])

                    @case('alt')
                        <x-spk.table-alternatif 
                            :alternatives="$alternatives" 
                            :columns="$columns" 
                        />
                    @break

                    @case('bobot')
                        <x-spk.table-bobot 
                            :criterias="$criterias" 
                            :weights="data_get($method, 'weights', [])" 
                        />
                    @break

                    @case('norm')
                        <x-spk.table-normalisasi 
                            :data="data_get($method, 'normalized', [])" 
                        />
                    @break

                    @case('normb')
                        <x-spk.table-normalisasi-terbobot 
                            :data="data_get($method, 'weighted', [])" 
                        />
                    @break

                    @case('ideal')
                        <x-spk.table-solusi-ideal 
                            :data="data_get($method, 'ideal', [])" 
                        />
                    @break

                    @case('rank')
                        <x-spk.table-rumus-jarak 
                            :data="data_get($method, 'ranking', [])" 
                        />
                    @break

                @endswitch

            </div>
        </div>

        @endforeach

    </div>
</div>

<script>
function accordionTab(){
    return{
        open:0,
        allOpen:false,

        toggle(i){
            if(this.allOpen) return
            this.open = this.open === i ? null : i
        },

        isOpen(i){
            return this.allOpen || this.open === i
        },

        openAll(){
            this.allOpen = true
        },

        closeAll(){
            this.allOpen = false
            this.open = null
        },

        reset(){
            this.open = 0
            this.allOpen = false
        }
    }
}
</script>