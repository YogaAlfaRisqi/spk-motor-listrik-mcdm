{{-- ===================== MOBILE TRIGGER BUTTON ===================== --}}
<div class="lg:hidden sticky top-[72px] z-30 -mx-3 sm:-mx-6 px-3 sm:px-6 py-3 bg-[#0A0C0F]/95 backdrop-blur border-b border-white/5">
    <button
        onclick="document.getElementById('filterDrawer').classList.remove('translate-x-full')"
        class="w-full flex items-center justify-between gap-2 bg-[#14161A] border border-white/10 rounded-xl px-4 py-3 text-sm font-bold text-white">
        <span class="flex items-center gap-2">
            <i class="ti ti-adjustments-horizontal" style="font-size:18px" aria-hidden="true"></i>
            Filter Pencarian
        </span>
        <span id="filterActiveBadge" class="hidden bg-[#C8F135] text-black text-[10px] font-extrabold rounded-full w-5 h-5 items-center justify-center"></span>
    </button>
</div>

{{-- ===================== SIDEBAR / DRAWER ===================== --}}
<aside class="lg:col-span-3">

    {{-- Mobile backdrop --}}
    <div
        id="filterBackdrop"
        onclick="closeFilterDrawer()"
        class="lg:hidden fixed inset-0 bg-black/60 z-40 opacity-0 pointer-events-none transition-opacity duration-300"
    ></div>

    {{-- Panel: drawer on mobile, sticky sidebar on desktop --}}
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
        {{-- Mobile header inside drawer --}}
        <div class="flex items-center justify-between mb-6 lg:hidden">
            <h2 class="font-syne font-extrabold text-xl text-[#C8F135] tracking-tight">
                Filter Pencarian
            </h2>
            <button onclick="closeFilterDrawer()" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/5 text-gray-400 hover:text-white transition" aria-label="Tutup filter">
                <i class="ti ti-x" style="font-size:18px" aria-hidden="true"></i>
            </button>
        </div>

        {{-- Desktop header --}}
        <div class="hidden lg:flex items-center justify-between mb-6">
            <h2 class="font-syne font-extrabold text-xl text-[#C8F135] tracking-tight">
                Filter Pencarian
            </h2>
            <button
                type="button"
                onclick="resetFilters()"
                class="text-[10px] font-bold text-gray-500 hover:text-[#C8F135] uppercase tracking-widest transition flex items-center gap-1">
                <i class="ti ti-refresh" style="font-size:13px" aria-hidden="true"></i>
                Reset
            </button>
        </div>

        <div class="space-y-8">

            {{-- Sorting --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">
                    Urutkan
                </label>
                <div class="relative">
                    <select id="filterSort" class="w-full bg-[#0A0C0F] border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-[#C8F135] outline-none appearance-none cursor-pointer">
                        <option value="terbaru">Terbaru</option>
                        <option value="harga_asc">Harga Terendah</option>
                        <option value="harga_desc">Harga Tertinggi</option>
                        <option value="jarak_desc">Jarak Tempuh Terjauh</option>
                        <option value="daya_desc">Daya Maksimum Tertinggi</option>
                    </select>
                    <i class="ti ti-chevron-down" style="font-size:16px" aria-hidden="true"></i>
                    <style>
                        #filterSort + i { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #6b7280; pointer-events: none; }
                    </style>
                </div>
            </div>

            {{-- Price range --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">
                    Rentang Harga
                </label>
                <div class="flex items-center justify-between mb-3 bg-[#0A0C0F] border border-white/10 rounded-xl px-4 py-2.5">
                    <span class="text-xs text-gray-500">Maks. harga</span>
                    <span id="priceOutput" class="text-sm font-extrabold text-[#C8F135]">Rp 100jt</span>
                </div>
                <input
                    id="priceRange"
                    type="range" min="10" max="100" value="100" step="5"
                    oninput="document.getElementById('priceOutput').textContent = 'Rp ' + this.value + 'jt'"
                    class="w-full accent-[#C8F135] cursor-pointer">
                <div class="flex justify-between text-[10px] mt-2 text-gray-500 font-bold">
                    <span>10jt</span>
                    <span>100jt</span>
                </div>
            </div>

            {{-- Brand --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4 flex items-center justify-between">
                    Brand
                    <span class="text-[#C8F135]" id="brandCount"></span>
                </label>

                <div class="space-y-1">
                    @foreach(['Gesits', 'Alva', 'Uwinfly', 'Polytron'] as $brand)
                    <label class="flex items-center justify-between gap-3 cursor-pointer group px-1 py-2 rounded-lg hover:bg-white/5 transition">
                        <span class="flex items-center gap-3">
                            <input
                                type="checkbox"
                                name="brand"
                                value="{{ $brand }}"
                                onchange="updateBrandCount()"
                                class="w-5 h-5 rounded border border-white/10 bg-[#0A0C0F]
                                       checked:bg-[#C8F135] checked:border-[#C8F135]
                                       appearance-none flex items-center justify-center
                                       relative
                                       before:content-['✓'] before:text-black before:text-[11px] before:font-black
                                       before:absolute before:inset-0 before:flex before:items-center before:justify-center
                                       before:opacity-0 checked:before:opacity-100">

                            <span class="text-sm text-gray-400 group-hover:text-white transition">
                                {{ $brand }}
                            </span>
                        </span>

                        <span class="text-[10px] text-gray-600 font-semibold">
                            {{ \App\Models\MotorListrik::where('nama_motor', 'like', '%'.$brand.'%')->count() }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Battery capacity quick filter --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">
                    Kapasitas Baterai
                </label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['Semua', '< 20 Ah', '20–40 Ah', '> 40 Ah'] as $i => $label)
                    <label class="cursor-pointer">
                        <input type="radio" name="battery" value="{{ $i }}" class="sr-only peer" {{ $i === 0 ? 'checked' : '' }}>
                        <div class="text-center text-[11px] font-semibold py-2.5 rounded-xl border border-white/10 bg-[#0A0C0F] text-gray-400
                                    peer-checked:bg-[#C8F135] peer-checked:text-black peer-checked:border-[#C8F135]
                                    hover:border-[#C8F135]/40 transition">
                            {{ $label }}
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="space-y-2 pt-2 sticky bottom-0 bg-[#14161A] pb-1">
                <button
                    type="button"
                    onclick="applyFilters()"
                    class="w-full py-4 bg-[#C8F135] text-black font-black text-xs uppercase tracking-tight rounded-xl hover:scale-[1.02] active:scale-95 transition flex items-center justify-center gap-2">
                    <i class="ti ti-filter" style="font-size:14px" aria-hidden="true"></i>
                    Terapkan Filter
                </button>
                <button
                    type="button"
                    onclick="resetFilters()"
                    class="w-full py-3 lg:hidden bg-transparent border border-white/10 text-gray-400 font-bold text-xs uppercase tracking-tight rounded-xl hover:text-white hover:border-white/20 transition">
                    Reset Semua
                </button>
            </div>

        </div>
    </div>
</aside>

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

    // hubungkan tombol trigger mobile ke openFilterDrawer
    document.addEventListener('DOMContentLoaded', () => {
        const trigger = document.querySelector('[onclick*="filterDrawer"][onclick*="remove"]');
        if (trigger) {
            trigger.setAttribute('onclick', 'openFilterDrawer()');
        }
    });

    function updateBrandCount() {
        const checked = document.querySelectorAll('input[name="brand"]:checked').length;
        const badge = document.getElementById('brandCount');
        const mobileBadge = document.getElementById('filterActiveBadge');

        badge.textContent = checked > 0 ? `${checked} dipilih` : '';

        if (checked > 0) {
            mobileBadge.textContent = checked;
            mobileBadge.classList.remove('hidden');
            mobileBadge.classList.add('flex');
        } else {
            mobileBadge.classList.add('hidden');
            mobileBadge.classList.remove('flex');
        }
    }

    function resetFilters() {
        document.getElementById('filterSort').value = 'terbaru';
        document.getElementById('priceRange').value = 100;
        document.getElementById('priceOutput').textContent = 'Rp 100jt';
        document.querySelectorAll('input[name="brand"]').forEach(el => el.checked = false);
        document.querySelector('input[name="battery"][value="0"]').checked = true;
        updateBrandCount();
    }

    function applyFilters() {
        // TODO: integrasikan dengan Livewire / fetch ke endpoint filter
        closeFilterDrawer();
    }
</script>
@endpush