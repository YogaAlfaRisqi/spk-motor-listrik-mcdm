<section class="hero" id="hero">
    <div class="hero-bg">
        <div class="glow-1"></div>
        <div class="glow-2"></div>
        <div class="hero-grid"></div>
    </div>
    <div class="hero-inner">
        <div class="hero-content">
            <div class="hero-label">
                <div class="pulse-dot"></div>
                Sistem Pendukung Keputusan
            </div>

            <h1 class="hero-title">
                Temukan Motor Listrik<br>
                <span class="accent">Terbaik Untukmu</span>
            </h1>

            <p class="hero-sub">
                Sistem Pendukung Keputusan menggunakan metode <strong style="color:var(--text)">TOPSIS</strong> untuk menganalisis dan merekomendasikan motor listrik yang paling sesuai dengan kebutuhan dan anggaran Anda.
            </p>

            <div class="hero-actions">
                <a href="#" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />
                    </svg>
                    Mulai Analisis Sekarang
                </a>
                <a href="#" class="btn-ghost">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polygon points="10 8 16 12 10 16 10 8" />
                    </svg>
                    Lihat Cara Kerja
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="num">30<span>+</span></span>
                    <span class="label">Motor Listrik</span>
                </div>
                <div class="hero-stat">
                    <span class="num">5</span>
                    <span class="label">Kriteria Penilaian</span>
                </div>
                <div class="hero-stat">
                    <span class="num">4</span>
                    <span class="label">Metode Pembobotan</span>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="float-card float-card-1">
                <div class="float-label">Skor Tertinggi</div>
                <div class="float-value">0.847</div>
            </div>

            <div class="score-card">
                <div class="score-card-header">
                    <div class="score-card-title">Hasil Analisis TOPSIS</div>
                    <div class="live-badge">
                        <div class="pulse-dot"></div> Live
                    </div>
                </div>

                <div class="motor-list">
                    @foreach($rankingROC as $index => $motor)
                    <div class="motor-item">
                        <div class="motor-rank">
                            {{ $index + 1 }}
                        </div>

                        <div class="motor-info">
                            <div class="motor-name">
                                {{ $motor['nama_motor'] }}
                            </div>
                            <div class="motor-brand">
                                {{ explode(' ', $motor['nama_motor'])[0] }}
                            </div>
                        </div>

                        <div class="motor-score-bar">
                            <div class="motor-score">
                                {{ number_format($motor['score'],3) }}
                            </div>

                            <div class="bar-bg">
                                <div class="bar-fill"
                                    style="width: {{ $motor['score'] * 100 }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="float-card float-card-2">
                <div class="float-label">Metode</div>
                <div class="float-value" style="font-size:0.85rem">TOPSIS</div>
            </div>
        </div>
    </div>
</section>