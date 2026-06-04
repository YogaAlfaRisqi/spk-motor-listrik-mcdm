<div class="min-h-screen bg-[#0D1117] text-[#E6EDF3]" style="font-family:'Plus Jakarta Sans',sans-serif;">

    {{-- ── BREADCRUMB HEADER ──────────────────────────── --}}
    <div class="bg-[#161B22] border-b border-[#30363D] px-4 sm:px-6 lg:px-8 py-4 sm:py-5">
        <h1 class="text-lg sm:text-xl lg:text-2xl font-extrabold text-[#E6EDF3] tracking-tight">
            Motor Listrik
        </h1>
        <p class="text-xs sm:text-sm text-[#8B949E] mt-1.5 flex items-center gap-1.5 flex-wrap">
            <span>Home</span>
            <span class="opacity-40">/</span>
            <span>EV</span>
            <span class="opacity-40">/</span>
            <strong class="text-[#C9D1D9] font-semibold">Motor Listrik</strong>
        </p>
    </div>

    {{-- ── MOBILE: Filter Toggle Button ──────────────── --}}
    <div class="lg:hidden px-4 pt-4">
        <button
            onclick="document.getElementById('sidebar-drawer').classList.toggle('hidden')"
            class="flex items-center gap-2 bg-[#161B22] border border-[#30363D] text-[#C9D1D9] text-sm font-semibold px-4 py-2.5 rounded-xl w-full justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M7 8h10M10 12h4" />
            </svg>
            Filter & Pencarian
        </button>
    </div>

    {{-- ── MAIN LAYOUT ─────────────────────────────────── --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 py-5 sm:py-7 pb-[160px] flex gap-6 items-start">

        {{-- ══ SIDEBAR ══════════════════════════════════ --}}
        <aside
            id="sidebar-drawer"
            class="hidden lg:flex flex-col gap-5 w-[220px] shrink-0 sticky top-[72px]">
            {{-- Search --}}
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 stroke-[#6E7681]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search"
                    class="w-full bg-[#161B22] border border-[#30363D] focus:border-[#58A6FF] rounded-full pl-8 pr-4 py-2 text-sm text-[#C9D1D9] placeholder-[#6E7681] outline-none transition-colors" />
            </div>

            {{-- Filter Model --}}
            <div class="bg-[#161B22] border border-[#30363D] rounded-xl p-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-[#E6EDF3] uppercase tracking-wider">Motor Listrik</span>
                    <svg class="w-3.5 h-3.5 stroke-[#6E7681]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
                <div class="flex flex-col gap-2.5">
                    @foreach ($this->motors as $motor)
                    <label class="flex items-center gap-2 text-sm text-[#8B949E] cursor-pointer select-none hover:text-[#C9D1D9] transition-colors">
                        <input
                            type="checkbox"
                            wire:click="toggleMotor({{ $motor['id'] }})"
                            @checked(in_array($motor['id'], $selected))
                            class="accent-[#58A6FF] w-3.5 h-3.5 cursor-pointer" />
                        {{ $motor['short_name'] ?? ($motor['brand'] . ' ' . ($motor['model'] ?? '')) }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Filter Harga --}}
            <div class="bg-[#161B22] border border-[#30363D] rounded-xl p-4">
                <span class="text-xs font-bold text-[#E6EDF3] uppercase tracking-wider block mb-3">Filter by price</span>
                <input type="range" class="w-full accent-[#58A6FF]" min="3000000" max="505500000" value="505500000" />
                <div class="flex items-center gap-2 mt-3 flex-wrap">
                    <button class="bg-[#21262D] hover:bg-[#2D333B] text-[#C9D1D9] border border-[#30363D] text-xs font-bold px-3.5 py-1.5 rounded-md transition-colors">
                        Filter
                    </button>
                    <span class="text-[11px] text-[#6E7681] leading-tight">Rp3jt — Rp505,5jt</span>
                </div>
            </div>

            {{-- Hapus Filter --}}
            <button class="text-[#F85149] hover:text-[#FF6B6B] text-sm font-medium text-left transition-colors bg-transparent border-none cursor-pointer p-0">
                Hapus semua filter
            </button>
        </aside>

        {{-- ══ KONTEN PRODUK ════════════════════════════ --}}
        <div class="flex-1 min-w-0">

            {{-- Sort Bar --}}
            <div class="flex items-center justify-between mb-5 gap-3 flex-wrap">
                <p class="text-sm text-[#6E7681]">
                    Menampilkan
                    <strong class="text-[#C9D1D9]">{{ count($this->motors) }}</strong>
                    produk
                </p>
                <select class="bg-[#161B22] border border-[#30363D] text-[#C9D1D9] rounded-full px-4 py-2 text-sm outline-none cursor-pointer">
                    <option>Terlaris</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                </select>
            </div>

            {{-- ── Grid Produk ────────────────────────── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

                @foreach ($this->motors as $motor)
                @php $isSelected = in_array($motor['id'], $selected); @endphp

                <div class="bg-[#161B22] rounded-2xl overflow-hidden flex flex-col transition-all duration-200
                    {{ $isSelected
                        ? 'border-2 border-[#3FB950] shadow-[0_0_0_3px_rgba(63,185,80,0.15)]'
                        : 'border border-[#30363D] shadow-[0_2px_8px_rgba(0,0,0,0.3)] hover:border-[#484F58] hover:shadow-[0_4px_16px_rgba(0,0,0,0.4)]' }}">

                    {{-- Brand Header --}}
                    <div class="bg-[#0D1117] flex flex-col items-center py-3 border-b border-[#21262D]">
                        <span class="text-[#FF4E4E] font-black text-sm tracking-[.14em] uppercase leading-none">
                            {{ strtoupper($motor['brand']) }}
                        </span>
                        <span class="text-[9px] tracking-[.22em] text-[#6E7681] uppercase mt-0.5">
                            Official Store
                        </span>
                    </div>

                    {{-- Gambar --}}
                    <div class="bg-[#0D1117] flex items-center justify-center h-40 sm:h-44 px-4 py-3">
                        <img
                            src="{{ $motor['image'] }}"
                            alt="{{ $motor['name'] }}"
                            class="max-h-full max-w-full object-contain opacity-90" />
                    </div>

                    {{-- Spesifikasi 4-kolom --}}
                    <div class="bg-[#0D1117] grid grid-cols-4 text-center px-3 pb-3 gap-1 border-b border-[#21262D]">
                        @foreach ([
                        ['val' => $motor['range'], 'lbl' => 'Range'],
                        ['val' => $motor['top_speed'], 'lbl' => 'Top Speed'],
                        ['val' => $motor['motor_power'], 'lbl' => 'Motor Power'],
                        ['val' => $motor['battery'], 'lbl' => 'Battery'],
                        ] as $spec)
                        <div>
                            <p class="text-[11px] font-bold text-[#C9D1D9] leading-tight m-0">{{ $spec['val'] }}</p>
                            <p class="text-[9.5px] text-[#6E7681] mt-0.5 m-0">{{ $spec['lbl'] }}</p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Badge Region --}}
                    <div class="bg-[#8B1A1A] text-[#FFD0D0] text-center text-[10.5px] font-extrabold py-1.5 uppercase tracking-[.07em] leading-snug px-2">
                        {{ $motor['region'] }}
                    </div>

                    {{-- Info & Harga --}}
                    <div class="p-3.5 flex flex-col flex-1">
                        <p class="text-[12.5px] text-[#8B949E] font-medium leading-relaxed mb-3 line-clamp-3">
                            {{ $motor['name'] }}
                        </p>

                        <div class="mt-auto">
                            <p class="text-xs text-[#6E7681] line-through m-0">{{ $motor['original_price'] }}</p>
                            <p class="text-xs text-[#F85149] font-semibold mt-0.5 m-0">Hemat {{ $motor['discount'] }}</p>
                            <p class="text-xl font-black text-[#E6EDF3] tracking-tight mt-0.5 mb-3">{{ $motor['price'] }}</p>

                            <div class="flex gap-2">
                                <button class="flex-1 bg-transparent border border-[#30363D] hover:border-[#484F58] hover:bg-[#21262D] text-[#C9D1D9] text-xs font-bold py-2 rounded-lg transition-colors cursor-pointer">
                                    Lebih Detail
                                </button>
                                <button
                                    wire:click="toggleMotor({{ $motor['id'] }})"
                                    class="flex-1 text-white text-xs font-bold py-2 rounded-lg transition-colors cursor-pointer border-none
                                        {{ $isSelected ? 'bg-[#238636] hover:bg-[#2EA043]' : 'bg-[#DA3633] hover:bg-[#F85149]' }}">
                                    {{ $isSelected ? '✓ Dipilih' : 'Beli Sekarang' }}
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>{{-- /grid --}}
        </div>{{-- /konten --}}
    </div>{{-- /main --}}


    {{-- ══════════════════════════════════════════════════
         STICKY BAR — BANDINGKAN
    ══════════════════════════════════════════════════ --}}
    {{-- ══ STICKY BAR — BANDINGKAN ══════════════════════════════ --}}
    <div
        x-data="{ open: true }"
        class="fixed bottom-0 left-0 right-0 z-50">
        {{-- ── Toggle Tab (selalu visible) ───────────────────── --}}
        <div class="flex justify-center">
            <button
                @click="open = !open"
                class="flex items-center gap-2 bg-[#161B22] border border-b-0 border-[#30363D] text-[#C9D1D9] text-xs font-bold px-5 py-1.5 rounded-t-xl hover:bg-[#21262D] transition-colors">
                <svg
                    class="w-3.5 h-3.5 transition-transform duration-300"
                    :class="open ? 'rotate-0' : 'rotate-180'"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span x-text="open ? 'Sembunyikan' : 'Bandingkan (' + {{ count($selected) }} + ')'"></span>
            </button>
        </div>

        {{-- ── Panel Utama ─────────────────────────────────────── --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="bg-[#161B22] border-t border-[#30363D] shadow-[0_-8px_32px_rgba(0,0,0,0.6)]">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 py-3 sm:py-4">

                {{-- ── Header row ─────────────────────────────── --}}
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <span class="text-sm sm:text-base font-extrabold text-[#E6EDF3]">Bandingkan</span>
                        <p class="text-xs text-[#6E7681] mt-0.5 m-0">
                            <span class="{{ count($selected) >= 3 ? 'text-[#3FB950]' : 'text-[#C9D1D9]' }} font-bold">
                                {{ count($selected) }} varian
                            </span>
                            ditambahkan &mdash; maks. 4 varian
                        </p>
                    </div>

                    {{-- Status pill --}}
                    @if(!$this->isValid)
                    <span class="hidden sm:inline-flex items-center gap-1.5 bg-[#21262D] border border-[#30363D] text-[#6E7681] text-xs font-semibold px-3 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#6E7681] inline-block"></span>
                        Pilih min. 3 motor
                    </span>
                    @else
                    <span class="hidden sm:inline-flex items-center gap-1.5 bg-[#0D1117] border border-[#3FB950] text-[#3FB950] text-xs font-semibold px-3 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#3FB950] inline-block"></span>
                        Siap dibandingkan
                    </span>
                    @endif
                </div>

                {{-- ── Slot Row ────────────────────────────────── --}}
                <div class="flex items-center gap-2 sm:gap-3">

                    {{-- Scrollable slots area --}}
                    <div class="flex items-center gap-2 sm:gap-3 flex-1 overflow-x-auto pb-1 min-w-0
                            [&::-webkit-scrollbar]:h-[3px]
                            [&::-webkit-scrollbar-track]:bg-transparent
                            [&::-webkit-scrollbar-thumb]:bg-[#30363D]
                            [&::-webkit-scrollbar-thumb]:rounded-full">

                        {{-- Motor terpilih --}}
                        @foreach ($this->motors as $motor)
                        @if (in_array($motor['id'], $selected))
                        <div class="relative flex items-center gap-2 sm:gap-2.5
                                bg-[#0D1117] border border-[#30363D] rounded-xl
                                px-2.5 sm:px-3 py-2 sm:py-2.5 shrink-0
                                min-w-[145px] sm:min-w-[165px] max-w-[185px]">

                            {{-- ✕ hapus --}}
                            <button
                                wire:click="toggleMotor({{ $motor['id'] }})"
                                class="absolute -top-2 -right-2 z-10
                                   w-5 h-5 rounded-full
                                   bg-[#DA3633] hover:bg-[#F85149]
                                   text-white border-2 border-[#161B22]
                                   text-[10px] font-black leading-none
                                   flex items-center justify-center
                                   cursor-pointer transition-colors">✕</button>

                            {{-- Thumbnail --}}
                            <div class="w-10 h-10 sm:w-11 sm:h-11 shrink-0
                                    bg-[#161B22] border border-[#21262D] rounded-lg
                                    flex items-center justify-center overflow-hidden">
                                <img
                                    src="{{ $motor['image'] }}"
                                    alt="{{ $motor['brand'] }}"
                                    class="max-w-full max-h-full object-contain opacity-90" />
                            </div>

                            {{-- Info --}}
                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] sm:text-xs font-bold text-[#E6EDF3] truncate m-0 leading-tight">
                                    {{ $motor['brand'] }}
                                </p>
                                <p class="text-[11px] sm:text-xs font-extrabold text-[#E6EDF3] m-0 leading-tight mt-0.5">
                                    {{ $motor['price'] }}
                                </p>
                                <p class="text-[10px] text-[#58A6FF] flex items-center gap-1 m-0 mt-0.5 leading-tight">
                                    <span class="truncate">{{ $motor['model'] ?? 'Standard' }}</span>
                                    <svg class="w-2.5 h-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </p>
                            </div>
                        </div>
                        @endif
                        @endforeach

                        {{-- Slot kosong --}}
                        @for ($i = count($selected); $i < 4; $i++)
                            <div class="flex items-center gap-2
                                border border-dashed border-[#1F6FEB] rounded-xl
                                px-3 py-2 sm:py-2.5 shrink-0 text-[#58A6FF]
                                min-w-[120px] sm:min-w-[140px]">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 shrink-0
                                    border border-dashed border-[#1F6FEB] rounded-lg
                                    flex items-center justify-center
                                    text-base font-bold">+</div>
                            <span class="text-xs font-semibold whitespace-nowrap">Pilih Motor</span>
                    </div>
                    @endfor

                </div>{{-- /scrollable --}}

                {{-- Tombol Bandingkan (selalu di kanan, tidak ikut scroll) --}}
                <button
                    wire:click="$dispatch('analyzeMotors', { ids: @js($selected) })"
                    @disabled(!$this->isValid)
                    class="shrink-0 self-center
                    px-4 sm:px-7 lg:px-9
                    py-2.5 sm:py-3
                    rounded-xl border-none
                    text-xs sm:text-sm font-extrabold tracking-wide
                    whitespace-nowrap transition-all duration-200
                    {{ $this->isValid
                               ? 'bg-[#DA3633] text-white cursor-pointer hover:bg-[#F85149] shadow-[0_4px_20px_rgba(218,54,51,0.4)] active:scale-95'
                               : 'bg-[#21262D] text-[#6E7681] cursor-not-allowed' }}"
                    {{ !$this->isValid ? 'disabled' : '' }}
                    >
                    {{-- Mobile: icon saja --}}
                    <span class="sm:hidden">
                        <svg class="w-4 h-4 {{ $this->isValid ? 'text-white' : 'text-[#6E7681]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </span>
                    {{-- Tablet ke atas: teks --}}
                    <span class="hidden sm:inline">Bandingkan</span>
                </button>

            </div>{{-- /slot row --}}
        </div>
    </div>
</div>

</div>