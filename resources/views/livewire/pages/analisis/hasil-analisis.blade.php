<div class="min-h-screen bg-[#0A0C0F] text-white px-4 pt-[120px] pb-20 md:px-12">

    {{-- ================= HEADER ================= --}}
    <div class="max-w-6xl mx-auto mb-10">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-5">
            <a href="{{ url('/') }}" class="hover:text-[#C8F135] transition flex items-center gap-1">
                <i class="ti ti-home" style="font-size:14px" aria-hidden="true"></i>
                Beranda
            </a>
            <i class="ti ti-chevron-right" style="font-size:12px" aria-hidden="true"></i>
            <a href="{{ url('/motor-overview') }}" class="hover:text-[#C8F135] transition">Daftar Motor</a>
            <i class="ti ti-chevron-right" style="font-size:12px" aria-hidden="true"></i>
            <span class="text-gray-300">Hasil Perbandingan</span>
        </nav>

        {{-- Hero --}}
        <div class="relative overflow-hidden rounded-3xl border border-white/5 bg-gradient-to-br from-[#14161A] via-[#14161A] to-[#0A0C0F] p-6 sm:p-10">

            {{-- Decorative grid --}}
            <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
                 style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 48px 48px;"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 bg-[#C8F135]/10 border border-[#C8F135]/30 rounded-full px-3 py-1.5 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#C8F135] animate-pulse"></span>
                        <span class="text-[10px] font-bold text-[#C8F135] uppercase tracking-widest">Powered by SPK · TOPSIS</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight">
                        Hasil Perbandingan
                        <span class="text-[#C8F135]">Motor Listrik</span>
                    </h1>

                    <p class="text-gray-400 mt-3 text-sm sm:text-base leading-relaxed">
                        Bandingkan spesifikasi motor pilihan Anda secara berdampingan, lalu lihat
                        rekomendasi sistem berdasarkan analisis multi-kriteria — harga, jarak tempuh,
                        waktu pengisian, kapasitas baterai, dan daya maksimum.
                    </p>

                    <a href="{{ url('/motor-overview') }}"
                       class="inline-flex items-center gap-2 mt-6 text-xs font-semibold text-gray-300 hover:text-[#C8F135] border border-white/10 hover:border-[#C8F135]/40 rounded-full px-4 py-2 transition">
                        <i class="ti ti-arrow-left" style="font-size:14px" aria-hidden="true"></i>
                        Kembali ke Daftar Motor
                    </a>
                </div>

                {{-- Stat panel --}}
                <div class="flex gap-3 shrink-0">
                    <div class="bg-[#0A0C0F] border border-white/5 rounded-2xl px-5 py-4 text-center min-w-[100px]">
                        <p class="text-2xl font-extrabold text-[#C8F135]">{{ $this->motors->count() }}</p>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wide mt-1">Motor Dibandingkan</p>
                    </div>
                    <div class="bg-[#0A0C0F] border border-white/5 rounded-2xl px-5 py-4 text-center min-w-[100px]">
                        <p class="text-2xl font-extrabold text-white">5</p>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wide mt-1">Kriteria Analisis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= EMPTY STATE ================= --}}
    @if($this->motors->isEmpty())
        <div class="max-w-2xl mx-auto bg-[#14161A] border border-white/5 rounded-2xl p-10 text-center">
            <div class="text-5xl mb-4">🏍️</div>
            <p class="text-gray-300 text-lg mb-2">Belum ada motor yang dipilih.</p>
            <p class="text-gray-500 text-sm mb-6">
                Silakan pilih minimal 2 motor dari halaman Motor untuk memulai perbandingan.
            </p>
            <a href="{{ url('/motor-overview') }}"
               class="inline-block bg-[#C8F135] text-black font-bold px-6 py-3 rounded-xl hover:bg-[#d9f540] transition">
                Pilih Motor
            </a>
        </div>

    @else
        @php
            $analysis  = $this->analysis;
            $menuTabs  = $this->menuTabs;
            $columns   = $this->columns;
            $criterias = $this->criterias;
            $weights   = $this->weights;
        @endphp

        {{-- ================= PANDUAN SINGKAT ================= --}}
        <div class="max-w-6xl mx-auto bg-[#14161A] border border-white/5 rounded-2xl p-5 mb-8">
            <h2 class="text-[#C8F135] font-bold mb-4 flex items-center gap-2">
                <span class="text-xl">💡</span> Cara Membaca Halaman Ini
            </h2>
            <div class="grid sm:grid-cols-2 gap-3">
                <div class="flex items-start gap-3 bg-[#0A0C0F] border border-white/5 rounded-xl p-3">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-[#C8F135]/10 text-[#C8F135] flex items-center justify-center text-sm">📊</span>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Tabel <b class="text-white">Perbandingan Spesifikasi</b> menampilkan data mentah tiap motor agar mudah dibandingkan baris per baris.
                    </p>
                </div>
                <div class="flex items-start gap-3 bg-[#0A0C0F] border border-white/5 rounded-xl p-3">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-[#C8F135]/10 text-[#C8F135] flex items-center justify-center text-sm">🧮</span>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Bagian <b class="text-white">Hasil Analisis SPK (TOPSIS)</b> menghitung skor kecocokan setiap motor terhadap bobot kepentingan tiap kriteria.
                    </p>
                </div>
                <div class="flex items-start gap-3 bg-[#0A0C0F] border border-white/5 rounded-xl p-3">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-[#C8F135]/10 text-[#C8F135] flex items-center justify-center text-sm">🏆</span>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Motor dengan <b class="text-[#C8F135]">skor preferensi tertinggi</b> mendapat <b class="text-white">peringkat #1</b> — paling mendekati kondisi "ideal" secara keseluruhan.
                    </p>
                </div>
                <div class="flex items-start gap-3 bg-[#0A0C0F] border border-white/5 rounded-xl p-3">
                    <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-[#C8F135]/10 text-[#C8F135] flex items-center justify-center text-sm">✅</span>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Bagian <b class="text-white">Rekomendasi</b> menjelaskan alasan setiap motor mendapat peringkat tersebut, kriteria mana yang membuatnya unggul atau kurang.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-white/5 text-[10px] text-gray-500">
                <span class="text-[#C8F135]">1</span><span>→</span>
                <span class="text-[#C8F135]">2</span><span>→</span>
                <span class="text-[#C8F135]">3</span><span>→</span>
                <span class="text-[#C8F135]">4</span>
                <span class="ml-2">Ikuti urutan ini dari atas ke bawah untuk memahami hasil dengan mudah.</span>
            </div>
        </div>

        {{-- ================= 1. TABEL PERBANDINGAN SPESIFIKASI ================= --}}
        <div class="max-w-6xl mx-auto mb-10">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                <span class="bg-[#C8F135] text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">1</span>
                Perbandingan Spesifikasi
            </h2>

            <div class="overflow-x-auto bg-[#14161A] border border-white/5 rounded-2xl">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="text-left p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A] z-10">Kriteria</th>
                            @foreach($this->motors as $motor)
                                <th class="p-4 text-left min-w-[200px]">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $motor->image ?: '/images/404 image.png' }}"
                                             alt="{{ $motor->nama_motor }}"
                                             class="w-12 h-12 object-cover rounded-lg bg-[#1a1d23] flex-shrink-0">
                                        <div>
                                            <div class="text-[#C8F135] font-bold leading-tight">{{ $motor->nama_motor }}</div>
                                            <div class="text-gray-500 text-xs">ID #{{ $motor->id_motor }}</div>
                                        </div>
                                    </div>
                                    {{-- Tombol hapus motor dari perbandingan --}}
                                    <button wire:click="removeMotor({{ $motor->id_motor }})"
                                            class="mt-2 text-[10px] text-red-400 hover:text-red-300 border border-red-400/20 hover:border-red-400/50 rounded-full px-2 py-0.5 transition">
                                        ✕ Hapus
                                    </button>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A] z-10">Harga</td>
                            @foreach($this->motors as $motor)
                                <td class="p-4 font-semibold">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                            @endforeach
                        </tr>
                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A] z-10">Jarak Tempuh</td>
                            @foreach($this->motors as $motor)
                                <td class="p-4">{{ $motor->jarak_tempuh }} km</td>
                            @endforeach
                        </tr>
                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A] z-10">Waktu Pengisian</td>
                            @foreach($this->motors as $motor)
                                <td class="p-4">{{ $motor->waktu_pengisian }} menit</td>
                            @endforeach
                        </tr>
                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A] z-10">Kapasitas Baterai</td>
                            @foreach($this->motors as $motor)
                                <td class="p-4">{{ $motor->kapasitas_baterai }} kWh</td>
                            @endforeach
                        </tr>
                        <tr class="hover:bg-white/5">
                            <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A] z-10">Daya Maksimum</td>
                            @foreach($this->motors as $motor)
                                <td class="p-4">{{ $motor->daya_maksimum }} kW</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= MINIMUM MOTOR WARNING ================= --}}
        @if($this->motors->count() < 2)
            <div class="max-w-6xl mx-auto bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 rounded-xl p-4 text-sm mb-10">
                ⚠️ Pilih minimal 2 motor untuk dapat menjalankan analisis SPK TOPSIS.
            </div>
        @else

            {{-- ================= 2. BOBOT KRITERIA PER METODE ================= --}}
            <div class="max-w-6xl mx-auto mb-10">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <span class="bg-[#C8F135] text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">2</span>
                    Bobot Kriteria per Metode Pembobotan
                </h2>
                <p class="text-gray-400 text-sm mb-4">
                    Setiap metode pembobotan menghasilkan bobot kriteria yang berbeda,
                    sehingga peringkat akhir tiap motor dapat bervariasi antar metode.
                </p>

                <div class="overflow-x-auto bg-[#14161A] border border-white/5 rounded-2xl">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-white/5 text-gray-400">
                                <th class="p-4 text-left sticky left-0 bg-[#14161A] z-10">Kriteria</th>
                                @foreach($menuTabs as $key => $tab)
                                    @if($key !== 'compare')
                                        <th class="p-4 text-left whitespace-nowrap">{{ $tab['title'] }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criterias as $c)
                                <tr class="border-b border-white/5 hover:bg-white/5">
                                    <td class="p-4 text-gray-300 font-medium sticky left-0 bg-[#14161A] z-10">
                                        {{ $c->nama_kriteria ?? $c->kode_kriteria }}
                                        <span class="text-gray-600 text-[10px] uppercase ml-2">
                                            {{ $c->tipe === 'benefit' ? 'Benefit ↑' : 'Cost ↓' }}
                                        </span>
                                    </td>
                                    @foreach($menuTabs as $key => $tab)
                                        @if($key !== 'compare')
                                            @php
                                                // Struktur weights: $weights[$key] = array of ['id_kriteria' => ..., 'bobot' => ...]
                                                $methodWeights = $weights[$key] ?? [];
                                                $bobotRow = collect($methodWeights)
                                                    ->firstWhere('id_kriteria', $c->id_kriteria);
                                                $bobot = $bobotRow['bobot'] ?? 0;
                                            @endphp
                                            <td class="p-4">
                                                <span class="text-[#C8F135] font-bold">
                                                    {{ number_format($bobot, 10) }}
                                                </span>
                                                {{-- Progress bar visual --}}
                                                <div class="mt-1 w-20 bg-white/5 rounded-full h-1 overflow-hidden">
                                                    <div class="h-1 bg-[#C8F135]/60 rounded-full"
                                                         style="width: {{ min($bobot * 100 * 4, 100) }}%"></div>
                                                </div>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ================= 3. HASIL ANALISIS PER METODE (TAB) ================= --}}
            <div class="max-w-6xl mx-auto mb-10">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <span class="bg-[#C8F135] text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">3</span>
                    Hasil Analisis TOPSIS per Metode Pembobotan
                </h2>

                {{-- Tab Navigation --}}
                <div class="flex gap-2 mb-5 overflow-x-auto pb-1">
                    @foreach($menuTabs as $key => $tab)
                        <button
                            wire:click="setActiveTab('{{ $key }}')"
                            class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition border
                            {{ $this->activeTab === $key
                                ? 'bg-[#C8F135] text-black border-[#C8F135]'
                                : 'bg-[#14161A] text-gray-400 border-white/5 hover:border-[#C8F135]/40 hover:text-white' }}">
                            {{ $tab['title'] }}
                        </button>
                    @endforeach
                </div>

                {{-- Tab Description --}}
                @php $activeMeta = $menuTabs[$this->activeTab]; @endphp
                <div class="bg-[#14161A] border border-white/5 rounded-xl p-4 mb-5">
                    <p class="text-sm text-gray-300 mb-1">{{ $activeMeta['desc'] }}</p>
                    @if($activeMeta['formula'] !== '-')
                        <p class="text-xs text-gray-500 font-mono mt-1">Formula: <span class="text-[#C8F135]">{{ $activeMeta['formula'] }}</span></p>
                    @endif
                </div>

                {{-- ===== TAB: EW / RS / RR / ROC ===== --}}
                @if($this->activeTab !== 'compare')
                    @php
                        $methodResult = $analysis['methods'][$this->activeTab] ?? [];
                        $ranking      = collect($methodResult['ranking'] ?? [])->sortBy('rank')->values();
                    @endphp

                    {{-- Ranking Table --}}
                    <div class="overflow-x-auto bg-[#14161A] border border-white/5 rounded-2xl mb-6">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-white/5 text-gray-400">
                                    <th class="p-4 text-left">Peringkat</th>
                                    <th class="p-4 text-left">Motor</th>
                                    <th class="p-4 text-left">D+ (Jarak ke Ideal+)</th>
                                    <th class="p-4 text-left">D− (Jarak ke Ideal−)</th>
                                    <th class="p-4 text-left">Skor Preferensi (V)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ranking as $row)
                                    <tr class="border-b border-white/5 {{ $row['rank'] === 1 ? 'bg-[#C8F135]/5' : '' }} hover:bg-white/5">
                                        <td class="p-4">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-sm
                                                {{ $row['rank'] === 1 ? 'bg-[#C8F135] text-black' : 'bg-white/5 text-gray-300' }}">
                                                {{ $row['rank'] }}
                                            </span>
                                        </td>
                                        <td class="p-4 font-semibold">
                                            <span class="{{ $row['rank'] === 1 ? 'text-[#C8F135]' : 'text-white' }}">
                                                {{ $row['nama_motor'] ?? ($row['name'] ?? '-') }}
                                            </span>
                                            @if($row['rank'] === 1)
                                                <span class="ml-2 text-[10px] bg-[#C8F135] text-black px-2 py-0.5 rounded-full font-bold">TERBAIK</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-gray-400 font-mono text-xs">
                                            {{ number_format($row['d_plus'] ?? 0, 4) }}
                                        </td>
                                        <td class="p-4 text-gray-400 font-mono text-xs">
                                            {{ number_format($row['d_minus'] ?? 0, 4) }}
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-24 bg-white/5 rounded-full h-2 overflow-hidden">
                                                    <div class="h-2 bg-[#C8F135] rounded-full"
                                                         style="width: {{ ($row['score'] ?? 0) * 100 }}%"></div>
                                                </div>
                                                <span class="font-bold text-[#C8F135]">
                                                    {{ number_format($row['score'] ?? 0, 4) }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Rekomendasi & Alasan --}}
                    <div class="grid md:grid-cols-2 gap-5">
                        @foreach($ranking as $row)
                            @php
                                // Cari motor yang sesuai untuk menghitung keunggulan/kekurangan
                                $motorObj  = $this->motors->first(fn($m) =>
                                    $m->nama_motor === ($row['nama_motor'] ?? ($row['name'] ?? ''))
                                );

                                // Hitung rata-rata setiap kriteria dari semua motor yang dibandingkan
                                $avgMap = [];
                                foreach ($columns as $col) {
                                    $avgMap[$col] = $this->motors->avg($col);
                                }

                                $labelMap = [
                                    'harga'            => ['label' => 'Harga',            'unit' => 'Rp', 'cost' => true],
                                    'jarak_tempuh'     => ['label' => 'Jarak Tempuh',     'unit' => 'km', 'cost' => false],
                                    'waktu_pengisian'  => ['label' => 'Waktu Pengisian',  'unit' => 'mnt','cost' => true],
                                    'kapasitas_baterai'=> ['label' => 'Kapasitas Baterai','unit' => 'kWh','cost' => false],
                                    'daya_maksimum'    => ['label' => 'Daya Maksimum',    'unit' => 'kW', 'cost' => false],
                                ];

                                $unggul = [];
                                $lemah  = [];

                                if ($motorObj) {
                                    foreach ($columns as $col) {
                                        $val  = (float) $motorObj->$col;
                                        $avg  = (float) ($avgMap[$col] ?? 0);
                                        $meta = $labelMap[$col] ?? ['label' => $col, 'unit' => '', 'cost' => false];

                                        // Benefit: lebih tinggi = lebih baik
                                        // Cost   : lebih rendah = lebih baik
                                        $isGood = $meta['cost'] ? ($val < $avg) : ($val > $avg);

                                        $entry = [
                                            'label' => $meta['label'],
                                            'value' => $val,
                                            'unit'  => $meta['unit'],
                                        ];

                                        if ($isGood) {
                                            $unggul[] = $entry;
                                        } elseif ($val != $avg) {
                                            $lemah[] = $entry;
                                        }
                                    }
                                }
                            @endphp

                            <div class="bg-[#14161A] border rounded-2xl p-5 {{ $row['rank'] === 1 ? 'border-[#C8F135]' : 'border-white/5' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold
                                                {{ $row['rank'] === 1 ? 'bg-[#C8F135] text-black' : 'bg-white/5 text-gray-300' }}">
                                                #{{ $row['rank'] }}
                                            </span>
                                            <h3 class="font-bold text-lg">
                                                {{ $row['nama_motor'] ?? ($row['name'] ?? '-') }}
                                            </h3>
                                        </div>
                                        <p class="text-gray-500 text-xs mt-1">
                                            Skor TOPSIS: <span class="text-[#C8F135] font-mono">{{ number_format($row['score'] ?? 0, 4) }}</span>
                                        </p>
                                    </div>
                                    @if($row['rank'] === 1)
                                        <span class="text-[10px] bg-[#C8F135] text-black px-2 py-1 rounded-full font-bold whitespace-nowrap">
                                            ✓ Rekomendasi Utama
                                        </span>
                                    @endif
                                </div>

                                @if($row['rank'] === 1)
                                    <p class="text-sm text-gray-300 mb-3">
                                        Motor ini direkomendasikan karena memiliki kombinasi nilai keseluruhan
                                        paling mendekati skenario ideal pada <b class="text-white">{{ $activeMeta['title'] }}</b> —
                                        paling jauh dari kondisi terburuk dan paling dekat dengan kondisi
                                        terbaik pada gabungan seluruh kriteria.
                                    </p>
                                @else
                                    <p class="text-sm text-gray-300 mb-3">
                                        Motor ini berada di peringkat {{ $row['rank'] }} pada
                                        <b class="text-white">{{ $activeMeta['title'] }}</b> karena nilai
                                        gabungannya berada di bawah pilihan teratas, meskipun mungkin
                                        masih unggul di beberapa aspek tertentu.
                                    </p>
                                @endif

                                @if(!empty($unggul))
                                    <div class="mb-3">
                                        <p class="text-xs text-[#C8F135] font-semibold mb-1.5">✓ Keunggulan:</p>
                                        <ul class="space-y-1">
                                            @foreach($unggul as $item)
                                                <li class="text-xs text-gray-400 flex items-center gap-1.5">
                                                    <span class="text-[#C8F135]">•</span>
                                                    {{ $item['label'] }} lebih baik dari rata-rata
                                                    <span class="font-mono text-gray-300">
                                                        ({{ $item['unit'] === 'Rp'
                                                            ? 'Rp '.number_format($item['value'], 0, ',', '.')
                                                            : number_format($item['value'], 0).' '.$item['unit'] }})
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(!empty($lemah))
                                    <div>
                                        <p class="text-xs text-red-400 font-semibold mb-1.5">✗ Kekurangan:</p>
                                        <ul class="space-y-1">
                                            @foreach($lemah as $item)
                                                <li class="text-xs text-gray-400 flex items-center gap-1.5">
                                                    <span class="text-red-400">•</span>
                                                    {{ $item['label'] }} di bawah rata-rata
                                                    <span class="font-mono text-gray-300">
                                                        ({{ $item['unit'] === 'Rp'
                                                            ? 'Rp '.number_format($item['value'], 0, ',', '.')
                                                            : number_format($item['value'], 0).' '.$item['unit'] }})
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(empty($unggul) && empty($lemah))
                                    <p class="text-xs text-gray-500 italic">Nilai semua kriteria setara dengan rata-rata motor yang dibandingkan.</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- ===== TAB: COMPARE ===== --}}
                @if($this->activeTab === 'compare')
                    @php
                        $comparison = $analysis['comparison'] ?? [];
                        $methodKeys = array_keys($analysis['methods'] ?? []);
                    @endphp

                    <div class="overflow-x-auto bg-[#14161A] border border-white/5 rounded-2xl">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-white/5 text-gray-400">
                                    <th class="p-4 text-left sticky left-0 bg-[#14161A] z-10">Motor</th>
                                    @foreach($methodKeys as $mKey)
                                        <th class="p-4 text-left whitespace-nowrap">
                                            {{ $menuTabs[$mKey]['title'] ?? $mKey }}
                                        </th>
                                    @endforeach
                                    <th class="p-4 text-left">Konsistensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comparison as $row)
                                    @php
                                        // Kumpulkan semua peringkat lalu cek konsistensi
                                        $ranks = collect($methodKeys)->map(fn($k) => $row[$k] ?? '-')->filter(fn($v) => is_int($v));
                                        $isConsistent = $ranks->unique()->count() === 1;
                                    @endphp
                                    <tr class="border-b border-white/5 hover:bg-white/5">
                                        <td class="p-4 font-semibold text-[#C8F135] sticky left-0 bg-[#14161A] z-10">
                                            {{ $row['name'] }}
                                        </td>
                                        @foreach($methodKeys as $mKey)
                                            <td class="p-4">
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-sm
                                                    {{ ($row[$mKey] ?? '-') === 1 ? 'bg-[#C8F135] text-black' : 'bg-white/5 text-gray-300' }}">
                                                    {{ $row[$mKey] ?? '-' }}
                                                </span>
                                            </td>
                                        @endforeach
                                        <td class="p-4">
                                            @if($isConsistent)
                                                <span class="text-[10px] bg-green-500/20 text-green-400 border border-green-500/30 px-2 py-0.5 rounded-full font-bold">
                                                    ✓ Konsisten
                                                </span>
                                            @else
                                                <span class="text-[10px] bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 px-2 py-0.5 rounded-full font-bold">
                                                    ~ Bervariasi
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <p class="text-gray-500 text-xs mt-3">
                        <span class="text-green-400 font-semibold">Konsisten</span> berarti motor mendapat peringkat yang sama di semua metode pembobotan.
                        <span class="text-yellow-400 font-semibold">Bervariasi</span> berarti peringkat berbeda tergantung metode — pertimbangkan metode yang paling sesuai dengan preferensi Anda.
                    </p>
                @endif
            </div>

            {{-- ================= 4. KESIMPULAN ================= --}}
            @php
                $bestPerMethod = collect($menuTabs)
                    ->except('compare')
                    ->map(function ($tab, $key) use ($analysis) {
                        $top = collect($analysis['methods'][$key]['ranking'] ?? [])
                                ->firstWhere('rank', 1);
                        return [
                            'method'     => $tab['title'],
                            'nama_motor' => $top['nama_motor'] ?? ($top['name'] ?? '-'),
                            'score'      => $top['score'] ?? 0,
                        ];
                    });

                // Temukan motor yang paling sering jadi #1
                $mostRecommended = $bestPerMethod
                    ->groupBy('nama_motor')
                    ->sortByDesc(fn($g) => $g->count())
                    ->keys()
                    ->first();
            @endphp

            <div class="max-w-6xl mx-auto bg-gradient-to-r from-[#C8F135]/10 to-transparent border border-[#C8F135]/30 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-[#C8F135] mb-1">📌 Kesimpulan</h2>

                @if($mostRecommended)
                    <p class="text-gray-400 text-sm mb-4">
                        <span class="text-[#C8F135] font-bold">{{ $mostRecommended }}</span>
                        menjadi pilihan terbaik pada
                        {{ $bestPerMethod->where('nama_motor', $mostRecommended)->count() }} dari {{ $bestPerMethod->count() }} metode pembobotan.
                    </p>
                @endif

                <ul class="text-gray-300 text-sm space-y-2">
                    @foreach($bestPerMethod as $item)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C8F135] flex-shrink-0"></span>
                            Pada <b class="text-white">{{ $item['method'] }}</b>, sistem merekomendasikan
                            <span class="text-[#C8F135] font-bold">{{ $item['nama_motor'] }}</span>
                            dengan skor preferensi <b class="font-mono">{{ number_format($item['score'], 4) }}</b>.
                        </li>
                    @endforeach
                </ul>

                <p class="text-gray-400 text-xs mt-4 pt-4 border-t border-white/5">
                    💡 Bandingkan hasil keempat metode pada tab <b class="text-white">Result Comparation</b>
                    untuk melihat konsistensi rekomendasi antar metode pembobotan.
                </p>
            </div>
        @endif {{-- end motors->count() >= 2 --}}
    @endif {{-- end motors not empty --}}
</div>