<div class="relative overflow-hidden border-b border-white/5 bg-gradient-to-b from-[#14161A] to-[#0A0C0F]">

    {{-- decorative grid --}}
    <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
         style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 48px 48px;"></div>

    {{-- glow accent --}}
    <div class="absolute -top-32 right-0 w-[420px] h-[420px] rounded-full bg-[#C8F135]/10 blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 pt-[120px] pb-12 lg:pb-16">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 bg-[#C8F135]/10 border border-[#C8F135]/30 rounded-full px-3 py-1.5 mb-5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#C8F135] animate-pulse"></span>
            <span class="text-[10px] font-bold text-[#C8F135] uppercase tracking-widest">Sistem pendukung keputusan · SPK TOPSIS</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
            <div class="max-w-2xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight font-syne">
                    Temukan motor listrik
                    <span class="text-[#C8F135]">paling cocok</span>
                    untuk Anda
                </h1>

                <p class="text-gray-400 mt-4 text-sm sm:text-base leading-relaxed max-w-xl">
                    Jelajahi katalog motor listrik dari berbagai brand, bandingkan
                    spesifikasi seperti harga, jarak tempuh, waktu pengisian, kapasitas
                    baterai, dan daya maksimum — lalu biarkan sistem membantu
                    merekomendasikan pilihan terbaik untuk Anda.
                </p>

                {{-- Search --}}
                <div class="mt-6 relative max-w-md">
                    <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500" style="font-size:18px" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Cari nama motor atau brand..."
                        class="w-full bg-[#0A0C0F] border border-white/10 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:border-[#C8F135] outline-none placeholder:text-gray-500">
                </div>

                {{-- Quick links --}}
                <div class="flex flex-wrap items-center gap-2 mt-4">
                    <span class="text-[10px] text-gray-500 uppercase font-bold tracking-widest mr-1">Populer:</span>
                    @foreach(['Gesits', 'Alva', 'Polytron', 'Uwinfly'] as $tag)
                        <button class="text-xs font-semibold text-gray-300 bg-white/5 hover:bg-[#C8F135]/10 hover:text-[#C8F135] border border-white/10 hover:border-[#C8F135]/30 rounded-full px-3 py-1.5 transition">
                            {{ $tag }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Stats panel --}}
            <div class="grid grid-cols-3 gap-3 shrink-0 w-full lg:w-auto">
                <div class="bg-[#14161A] border border-white/5 rounded-2xl px-4 sm:px-5 py-4 text-center">
                    <p class="text-2xl font-extrabold text-[#C8F135]">{{ \App\Models\MotorListrik::count() }}</p>
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wide mt-1">Total Motor</p>
                </div>
                <div class="bg-[#14161A] border border-white/5 rounded-2xl px-4 sm:px-5 py-4 text-center">
                    <p class="text-2xl font-extrabold text-white">4</p>
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wide mt-1">Brand</p>
                </div>
                <div class="bg-[#14161A] border border-white/5 rounded-2xl px-4 sm:px-5 py-4 text-center">
                    <p class="text-2xl font-extrabold text-white">5</p>
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wide mt-1">Kriteria SPK</p>
                </div>
            </div>
        </div>

        {{-- How it works strip --}}
        <div class="flex items-center gap-2 mt-8 pt-6 border-t border-white/5 text-[11px] text-gray-500 flex-wrap">
            <span class="flex items-center gap-1.5 text-gray-300 font-semibold">
                <i class="ti ti-click" style="font-size:14px" aria-hidden="true"></i>
                Pilih motor
            </span>
            <i class="ti ti-arrow-right" style="font-size:12px" aria-hidden="true"></i>
            <span class="flex items-center gap-1.5 text-gray-300 font-semibold">
                <i class="ti ti-stack-2" style="font-size:14px" aria-hidden="true"></i>
                Bandingkan
            </span>
            <i class="ti ti-arrow-right" style="font-size:12px" aria-hidden="true"></i>
            <span class="flex items-center gap-1.5 text-gray-300 font-semibold">
                <i class="ti ti-chart-bar" style="font-size:14px" aria-hidden="true"></i>
                Lihat hasil analisis
            </span>
            <span class="ml-1">— sistem akan merekomendasikan motor terbaik berdasarkan TOPSIS.</span>
        </div>
    </div>
</div>