<div class="lg:col-span-3">

    {{-- ── Mobile: sticky trigger button ── --}}
    <div class="lg:hidden sticky top-[72px] z-30 -mx-3 sm:-mx-6 px-3 sm:px-6 py-3 bg-[#0A0C0F]/95 backdrop-blur border-b border-white/5">
        <button
            onclick="openFilterDrawer()"
            class="w-full flex items-center justify-between gap-2 bg-[#14161A] border border-white/10 rounded-xl px-4 py-3 text-sm font-bold text-white">
            <span class="flex items-center gap-2">
                <i class="ti ti-adjustments-horizontal" style="font-size:18px" aria-hidden="true"></i>
                Filter Pencarian
            </span>
            @if (count($brands) > 0)
                <span class="bg-[#C8F135] text-black text-[10px] font-extrabold rounded-full w-5 h-5 flex items-center justify-center">
                    {{ count($brands) }}
                </span>
            @endif
        </button>
    </div>

    {{-- ── Backdrop (mobile) ── --}}
    <div
        id="filterBackdrop"
        onclick="closeFilterDrawer()"
        class="lg:hidden fixed inset-0 bg-black/60 z-40 opacity-0 pointer-events-none transition-opacity duration-300"
    ></div>

    {{-- ── Drawer / Sidebar ── --}}
    <div
        id="filterDrawer"
        class="
            fixed lg:sticky top-0 lg:top-[120px] right-0 z-50
            w-[85%] max-w-[340px] lg:w-auto lg:max-w-none
            h-full lg:h-auto lg:max-h-[calc(100vh-140px)]
            overflow-y-auto
            bg-[#14161A] border border-white/5 lg:rounded-2xl
            p-6
            translate-x-full lg:translate-x-0
            transition-transform duration-300 ease-out
        "
    >
        {{-- Header mobile --}}
        <div class="flex items-center justify-between mb-6 lg:hidden">
            <h2 class="font-syne font-extrabold text-xl text-[#C8F135] tracking-tight">Filter Pencarian</h2>
            <button onclick="closeFilterDrawer()" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/5 text-gray-400 hover:text-white transition" aria-label="Tutup filter">
                <i class="ti ti-x" style="font-size:18px" aria-hidden="true"></i>
            </button>
        </div>

        {{-- Header desktop --}}
        <div class="hidden lg:flex items-center justify-between mb-6">
            <h2 class="font-syne font-extrabold text-xl text-[#C8F135] tracking-tight">Filter Pencarian</h2>
            <button
                type="button"
                wire:click="resetFilter"
                class="text-[10px] font-bold text-gray-500 hover:text-[#C8F135] uppercase tracking-widest transition flex items-center gap-1">
                <i class="ti ti-refresh" style="font-size:13px" aria-hidden="true"></i>
                Reset
            </button>
        </div>

        <div class="space-y-8">

            {{-- ── Urutkan ── --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Urutkan</label>
                <div class="relative">
                    <select wire:model.live="sort" class="w-full bg-[#0A0C0F] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-[#C8F135] outline-none appearance-none cursor-pointer">
                        <option value="terbaru">Terbaru</option>
                        <option value="harga_asc">Harga Terendah</option>
                        <option value="harga_desc">Harga Tertinggi</option>
                        <option value="jarak_desc">Jarak Tempuh Terjauh</option>
                        <option value="daya_desc">Daya Maksimum Tertinggi</option>
                    </select>
                    <i class="ti ti-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none" style="font-size:16px" aria-hidden="true"></i>
                </div>
            </div>

            {{-- ── Rentang Harga ── --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Rentang Harga</label>
                <div class="flex items-center justify-between mb-3 bg-[#0A0C0F] border border-white/10 rounded-xl px-4 py-2.5">
                    <span class="text-xs text-gray-500">Maks. harga</span>
                    <span class="text-sm font-extrabold text-[#C8F135]">Rp {{ $maxHarga }}jt</span>
                </div>
                <input
                    type="range"
                    min="10"
                    max="100"
                    step="5"
                    wire:model.live="maxHarga"
                    class="w-full accent-[#C8F135] cursor-pointer">
                <div class="flex justify-between text-[10px] mt-2 text-gray-500 font-bold">
                    <span>10jt</span><span>100jt</span>
                </div>
            </div>

            {{-- ── Brand Dropdown ── --}}
            <div x-data="{ open: false }">
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">
                    Brand
                    @if (count($brands) > 0)
                        <span class="text-[#C8F135] ml-1 normal-case font-semibold">{{ count($brands) }} dipilih</span>
                    @endif
                </label>

                {{-- Trigger --}}
                <button
                    type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between gap-2 bg-[#0A0C0F] border rounded-xl px-4 py-3 text-sm transition"
                    :class="open ? 'border-[#C8F135]/50 text-white' : 'border-white/10 text-gray-400 hover:border-white/20 hover:text-white'"
                >
                    <span class="truncate">
                        @if (count($brands) === 0)
                            Semua brand
                        @elseif (count($brands) === 1)
                            {{ $brands[0] }}
                        @else
                            {{ $brands[0] }} +{{ count($brands) - 1 }} lainnya
                        @endif
                    </span>
                    <i
                        class="ti ti-chevron-down text-gray-500 shrink-0 transition-transform duration-200"
                        :class="open ? 'rotate-180 !text-[#C8F135]' : ''"
                        style="font-size:16px"
                        aria-hidden="true"
                    ></i>
                </button>

                {{-- Panel --}}
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-1"
                    class="mt-2 bg-[#0A0C0F] border border-white/10 rounded-xl overflow-hidden"
                    x-cloak
                >
                    {{-- Pilih semua / hapus --}}
                    @if ($availableBrands->count() > 0)
                        <div class="flex items-center justify-between px-4 py-2.5 border-b border-white/5">
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                {{ $availableBrands->count() }} brand tersedia
                            </span>
                            @if (count($brands) > 0)
                                <button
                                    type="button"
                                    wire:click="$set('brands', [])"
                                    class="text-[10px] font-semibold text-red-400 hover:text-red-300 transition">
                                    Hapus semua
                                </button>
                            @endif
                        </div>
                    @endif

                    {{-- Daftar brand --}}
                    <div class="max-h-52 overflow-y-auto py-1" style="scrollbar-width:thin;scrollbar-color:#C8F135 transparent">
                        @forelse ($availableBrands as $item)
                            <label class="flex items-center justify-between gap-3 cursor-pointer group px-4 py-2.5 hover:bg-white/5 transition">
                                <span class="flex items-center gap-3">
                                    <input
                                        type="checkbox"
                                        value="{{ $item['brand'] }}"
                                        wire:model.live="brands"
                                        class="w-4 h-4 shrink-0 rounded border border-white/10 bg-[#14161A]
                                               checked:bg-[#C8F135] checked:border-[#C8F135]
                                               appearance-none relative cursor-pointer
                                               before:content-['✓'] before:text-black before:text-[9px] before:font-black
                                               before:absolute before:inset-0 before:flex before:items-center before:justify-center
                                               before:opacity-0 checked:before:opacity-100 transition"
                                    >
                                    <span class="text-sm text-gray-400 group-hover:text-white transition">
                                        {{ $item['brand'] }}
                                    </span>
                                </span>
                                <span class="text-[10px] text-gray-600 font-semibold tabular-nums shrink-0">
                                    {{ $item['count'] }}
                                </span>
                            </label>
                        @empty
                            <p class="text-[11px] text-gray-600 text-center py-4">Tidak ada brand.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ── Kapasitas Baterai ── --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Kapasitas Baterai</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['Semua', '< 2.0', '2.0–3.0', '> 3.0'] as $i => $label)
                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="battery"
                                value="{{ $i }}"
                                wire:model.live="battery"
                                class="sr-only peer"
                                @checked($i === 0)>
                            <div class="text-center text-[11px] font-semibold py-2.5 rounded-xl border border-white/10 bg-[#0A0C0F] text-gray-400 peer-checked:bg-[#C8F135] peer-checked:text-black peer-checked:border-[#C8F135] hover:border-[#C8F135]/40 transition">
                                {{ $label }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- ── Mobile actions ── --}}
            <div class="space-y-2 pt-2 sticky bottom-0 bg-[#14161A] pb-1 lg:hidden">
                <button
                    type="button"
                    onclick="closeFilterDrawer()"
                    class="w-full py-4 bg-[#C8F135] text-black font-black text-xs uppercase tracking-tight rounded-xl hover:scale-[1.02] active:scale-95 transition flex items-center justify-center gap-2">
                    <i class="ti ti-filter" style="font-size:14px" aria-hidden="true"></i>
                    Terapkan Filter
                </button>
                <button
                    type="button"
                    wire:click="resetFilter"
                    class="w-full py-3 bg-transparent border border-white/10 text-gray-400 font-bold text-xs uppercase tracking-tight rounded-xl hover:text-white hover:border-white/20 transition">
                    Reset Semua
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
function openFilterDrawer() {
    document.getElementById('filterDrawer').classList.remove('translate-x-full');
    const backdrop = document.getElementById('filterBackdrop');
    backdrop.classList.remove('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'hidden';
}

function closeFilterDrawer() {
    document.getElementById('filterDrawer').classList.add('translate-x-full');
    const backdrop = document.getElementById('filterBackdrop');
    backdrop.classList.add('opacity-0', 'pointer-events-none');
    document.body.style.overflow = '';
}
</script>
@endpush