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
            <span class="text-gray-300">Hasil Perbandingan</span>
        </nav>

        {{-- Hero --}}
        <div class="relative overflow-hidden rounded-3xl border border-white/5 bg-gradient-to-br from-[#14161A] via-[#14161A] to-[#0A0C0F] p-6 sm:p-10">

            {{-- decorative grid lines --}}
            <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
                style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 48px 48px;"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="max-w-2xl">
                    {{-- Badge --}}
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

    @if($this->motors->isEmpty())
    {{-- ================= EMPTY STATE ================= --}}
    <div class="max-w-2xl mx-auto bg-[#14161A] border border-white/5 rounded-2xl p-10 text-center">
        <p class="text-gray-300 text-lg mb-2">Belum ada motor yang dipilih.</p>
        <p class="text-gray-500 text-sm mb-6">
            Silakan pilih minimal 2 motor dari halaman Beranda untuk memulai perbandingan.
        </p>
        <a href="{{ url('/') }}"
            class="inline-block bg-[#C8F135] text-black font-bold px-6 py-3 rounded-xl hover:bg-[#d9f540] transition">
            Kembali ke Daftar Motor
        </a>
    </div>
    @else

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
            <span class="text-[#C8F135]">1</span>
            <span>→</span>
            <span class="text-[#C8F135]">2</span>
            <span>→</span>
            <span class="text-[#C8F135]">3</span>
            <span>→</span>
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
                        <th class="text-left p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A]">Kriteria</th>
                        @foreach($this->motors as $motor)
                        <th class="p-4 text-left min-w-[180px]">
                            <div class="flex items-center gap-3">
                                <img src="{{ $motor->image ? $motor->image : '/images/404 image.png' }}"
                                    alt="{{ $motor->nama_motor }}"
                                    class="w-12 h-12 object-cover rounded-lg bg-[#1a1d23]">
                                <div>
                                    <div class="text-[#C8F135] font-bold leading-tight">{{ $motor->nama_motor }}</div>
                                    <div class="text-gray-500 text-xs">ID #{{ $motor->id_motor }}</div>
                                </div>
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-white/5 hover:bg-white/5">
                        <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A]">Harga</td>
                        @foreach($this->motors as $motor)
                        <td class="p-4 font-semibold">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                        @endforeach
                    </tr>
                    <tr class="border-b border-white/5 hover:bg-white/5">
                        <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A]">Jarak Tempuh</td>
                        @foreach($this->motors as $motor)
                        <td class="p-4">{{ $motor->jarak_tempuh }} km</td>
                        @endforeach
                    </tr>
                    <tr class="border-b border-white/5 hover:bg-white/5">
                        <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A]">Waktu Pengisian</td>
                        @foreach($this->motors as $motor)
                        <td class="p-4">{{ $motor->waktu_pengisian }} menit</td>
                        @endforeach
                    </tr>
                    <tr class="border-b border-white/5 hover:bg-white/5">
                        <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A]">Kapasitas Baterai</td>
                        @foreach($this->motors as $motor)
                        <td class="p-4">{{ $motor->kapasitas_baterai }} kWh</td>
                        @endforeach
                    </tr>
                    <tr class="hover:bg-white/5">
                        <td class="p-4 text-gray-400 font-medium sticky left-0 bg-[#14161A]">Daya Maksimum</td>
                        @foreach($this->motors as $motor)
                        <td class="p-4">{{ $motor->daya_maksimum }} kW</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if($this->motors->count() < 2)
        <div class="max-w-6xl mx-auto bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 rounded-xl p-4 text-sm mb-10">
        Pilih minimal 2 motor untuk dapat menjalankan analisis SPK TOPSIS.
</div>
@else
@php
$topsis = $this->topsisResult;
@endphp

{{-- ================= 2. BOBOT KRITERIA ================= --}}
<div class="max-w-6xl mx-auto mb-10">
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
        <span class="bg-[#C8F135] text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">2</span>
        Bobot Kriteria yang Digunakan
    </h2>
    <p class="text-gray-400 text-sm mb-4">
        Sistem memberi bobot pada setiap kriteria sesuai tingkat kepentingannya.
        Semakin besar persentase, semakin besar pengaruh kriteria tersebut terhadap peringkat akhir.
    </p>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach($this->weights as $key => $weight)
        <div class="bg-[#14161A] border border-white/5 rounded-xl p-4 text-center">
            <div class="text-2xl font-extrabold text-[#C8F135]">{{ number_format($weight * 100, 0) }}%</div>
            <div class="text-gray-400 text-xs mt-1">{{ $this->criteriaLabel[$key] }}</div>
            <div class="text-gray-600 text-[10px] mt-1 uppercase">
                {{ $this->criteriaType[$key] === 'benefit' ? 'Makin besar makin baik' : 'Makin kecil makin baik' }}
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ================= 3. HASIL ANALISIS TOPSIS ================= --}}
<div class="max-w-6xl mx-auto mb-10">
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
        <span class="bg-[#C8F135] text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">3</span>
        Hasil Analisis SPK (Metode TOPSIS)
    </h2>
    <p class="text-gray-400 text-sm mb-4">
        Skor preferensi dihitung berdasarkan jarak setiap motor terhadap solusi ideal positif
        (kombinasi terbaik dari semua kriteria) dan solusi ideal negatif (kombinasi terburuk).
        Skor mendekati <b class="text-white">1</b> berarti motor tersebut paling mendekati kondisi ideal.
    </p>

    <div class="overflow-x-auto bg-[#14161A] border border-white/5 rounded-2xl">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5 text-gray-400">
                    <th class="p-4 text-left">Peringkat</th>
                    <th class="p-4 text-left">Motor</th>
                    <th class="p-4 text-left">Jarak ke Ideal (+)</th>
                    <th class="p-4 text-left">Jarak ke Ideal (-)</th>
                    <th class="p-4 text-left">Skor Preferensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topsis['ranked_ids'] as $i => $idMotor)
                @php
                $motor = $this->motors->firstWhere('id_motor', $idMotor);
                $result = $topsis['results'][$idMotor];
                @endphp
                <tr class="border-b border-white/5 {{ $i === 0 ? 'bg-[#C8F135]/10' : '' }} hover:bg-white/5">
                    <td class="p-4">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold
                                            {{ $i === 0 ? 'bg-[#C8F135] text-black' : 'bg-white/5 text-gray-300' }}">
                            {{ $i + 1 }}
                        </span>
                    </td>
                    <td class="p-4 font-semibold text-[#C8F135]">
                        {{ $motor->nama_motor }}
                        @if($i === 0)
                        <span class="ml-2 text-[10px] bg-[#C8F135] text-black px-2 py-0.5 rounded-full font-bold">TERBAIK</span>
                        @endif
                    </td>
                    <td class="p-4 text-gray-400">{{ number_format($result['d_positive'], 4) }}</td>
                    <td class="p-4 text-gray-400">{{ number_format($result['d_negative'], 4) }}</td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <div class="w-24 bg-white/5 rounded-full h-2 overflow-hidden">
                                <div class="h-2 bg-[#C8F135]" style="width: {{ $result['score'] * 100 }}%"></div>
                            </div>
                            <span class="font-bold">{{ number_format($result['score'], 4) }}</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ================= 4. REKOMENDASI & ALASAN ================= --}}
<div class="max-w-6xl mx-auto mb-10">
    <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
        <span class="bg-[#C8F135] text-black w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">4</span>
        Rekomendasi & Alasan Sistem
    </h2>

    <div class="grid md:grid-cols-2 gap-5">
        @foreach($topsis['ranked_ids'] as $i => $idMotor)
        @php
        $motor = $this->motors->firstWhere('id_motor', $idMotor);
        $alasan = $this->getAlasan($idMotor);
        $result = $topsis['results'][$idMotor];
        @endphp
        <div class="bg-[#14161A] border rounded-2xl p-5 {{ $i === 0 ? 'border-[#C8F135]' : 'border-white/5' }}">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold
                                            {{ $i === 0 ? 'bg-[#C8F135] text-black' : 'bg-white/5 text-gray-300' }}">
                            #{{ $i + 1 }}
                        </span>
                        <h3 class="font-bold text-lg">{{ $motor->nama_motor }}</h3>
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Skor TOPSIS: {{ number_format($result['score'], 4) }}</p>
                </div>
                @if($i === 0)
                <span class="text-[10px] bg-[#C8F135] text-black px-2 py-1 rounded-full font-bold whitespace-nowrap">
                    ✓ Rekomendasi Utama
                </span>
                @endif
            </div>

            @if($i === 0)
            <p class="text-sm text-gray-300 mb-3">
                Motor ini direkomendasikan karena memiliki kombinasi nilai
                keseluruhan paling mendekati skenario ideal — secara
                perhitungan, motor ini paling jauh dari "kondisi terburuk"
                dan paling dekat dengan "kondisi terbaik" pada gabungan
                seluruh kriteria yang dinilai.
            </p>
            @else
            <p class="text-sm text-gray-300 mb-3">
                Motor ini berada di peringkat {{ $i + 1 }} karena secara
                keseluruhan nilai gabungannya sedikit di bawah pilihan
                teratas, meskipun mungkin masih unggul di beberapa aspek
                tertentu.
            </p>
            @endif

            @if(!empty($alasan['unggul']))
            <div class="mb-2">
                <p class="text-xs text-[#C8F135] font-semibold mb-1">✓ Keunggulan:</p>
                <ul class="text-xs text-gray-400 space-y-1">
                    @foreach($alasan['unggul'] as $item)
                    <li>
                        • {{ $item['label'] }} unggul dibanding rata-rata
                        ({{ number_format($item['value'], 0) }} {{ $item['unit'] }})
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($alasan['lemah']))
            <div>
                <p class="text-xs text-red-400 font-semibold mb-1">✗ Kekurangan:</p>
                <ul class="text-xs text-gray-400 space-y-1">
                    @foreach($alasan['lemah'] as $item)
                    <li>
                        • {{ $item['label'] }} di bawah rata-rata
                        ({{ number_format($item['value'], 0) }} {{ $item['unit'] }})
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

{{-- ================= 5. KESIMPULAN ================= --}}
@php
$best = $this->motors->firstWhere('id_motor', $topsis['ranked_ids'][0]);
$bestScore = $topsis['results'][$topsis['ranked_ids'][0]]['score'];
@endphp
<div class="max-w-6xl mx-auto bg-gradient-to-r from-[#C8F135]/10 to-transparent border border-[#C8F135]/30 rounded-2xl p-6">
    <h2 class="text-lg font-bold text-[#C8F135] mb-2">📌 Kesimpulan</h2>
    <p class="text-gray-300 text-sm">
        Berdasarkan perhitungan SPK metode TOPSIS dengan mempertimbangkan
        harga, jarak tempuh, waktu pengisian, kapasitas baterai, dan daya
        maksimum, sistem merekomendasikan
        <span class="text-[#C8F135] font-bold">{{ $best->nama_motor }}</span>
        sebagai pilihan terbaik dengan skor preferensi
        <span class="font-bold">{{ number_format($bestScore, 4) }}</span>
        dari skala 0–1. Anda tetap dapat mempertimbangkan motor lain
        apabila terdapat kriteria spesifik yang lebih Anda prioritaskan
        dibanding bobot default sistem.
    </p>
</div>
@endif

@endif
</div>