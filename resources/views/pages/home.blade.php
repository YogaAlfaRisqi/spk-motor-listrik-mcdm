<x-layouts.app>
    @push('styles')
    <style>
        /* ============================================================
           LANDING PAGE – ElectroChoice
        ============================================================ */

        /* ----- HERO ----- */
        .hero {
            min-height: 100vh;
            padding: 120px 24px 80px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        /* Radial glows */
        .glow-1 {
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(200,241,53,0.12) 0%, transparent 65%);
            top: -200px;
            right: -100px;
        }
        .glow-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(200,241,53,0.06) 0%, transparent 65%);
            bottom: -100px;
            left: -100px;
        }

        /* Grid overlay */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, rgba(0,0,0,0.5) 0%, transparent 70%);
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            width: 100%;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(200,241,53,0.08);
            border: 1px solid rgba(200,241,53,0.25);
            border-radius: 24px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--lime);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 24px;
            animation: fadeUp 0.6s ease forwards;
        }

        .pulse-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--lime);
            animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%,100%{opacity:1; transform:scale(1)} 50%{opacity:0.4; transform:scale(0.7)} }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.03em;
            line-height: 1.1;
            animation: fadeUp 0.6s 0.1s ease both;
        }

        .hero-title .accent {
            color: var(--lime);
            position: relative;
            display: inline-block;
        }

        .hero-title .accent::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--lime);
            border-radius: 2px;
            animation: lineIn 0.8s 0.7s ease both;
            transform-origin: left;
        }
        @keyframes lineIn { from { scaleX: 0 } to { scaleX: 1 } }

        .hero-sub {
            margin-top: 20px;
            font-size: 1.1rem;
            color: var(--text-soft);
            max-width: 480px;
            line-height: 1.7;
            animation: fadeUp 0.6s 0.2s ease both;
        }

        .hero-actions {
            margin-top: 36px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            animation: fadeUp 0.6s 0.3s ease both;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            background: var(--lime);
            color: var(--dark);
            border-radius: 12px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .btn-primary:hover {
            background: var(--lime-dark);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(200,241,53,0.3);
        }
        .btn-primary svg { width: 18px; height: 18px; }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            background: transparent;
            color: var(--text);
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.1);
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .btn-ghost:hover {
            border-color: rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.04);
        }
        .btn-ghost svg { width: 18px; height: 18px; }

        .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 48px;
            animation: fadeUp 0.6s 0.4s ease both;
        }

        .hero-stat { }
        .hero-stat .num {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--white);
            display: block;
        }
        .hero-stat .num span { color: var(--lime); }
        .hero-stat .label {
            font-size: 0.8rem;
            color: var(--muted);
            display: block;
            margin-top: 2px;
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            animation: fadeUp 0.8s 0.2s ease both;
            
        }

        .score-card {
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .score-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--lime), transparent);
        }

        .score-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .score-card-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .live-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(200,241,53,0.1);
            border: 1px solid rgba(200,241,53,0.2);
            border-radius: 12px;
            padding: 3px 10px;
            font-size: 0.72rem;
            color: var(--lime);
            font-weight: 600;
        }

        .motor-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .motor-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: var(--dark-3);
            border: 1px solid rgba(255,255,255,0.05);
            transition: border-color 0.2s;
        }

        .motor-item:first-child {
            background: rgba(200,241,53,0.06);
            border-color: rgba(200,241,53,0.2);
        }

        .motor-rank {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--dark-4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.8rem;
            color: var(--muted);
            flex-shrink: 0;
        }

        .motor-item:first-child .motor-rank {
            background: var(--lime);
            color: var(--dark);
        }

        .motor-info { flex: 1; }
        .motor-name {
            font-family: 'Syne', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text);
        }
        .motor-item:first-child .motor-name { color: var(--lime); }

        .motor-brand {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 1px;
        }

        .motor-score-bar {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }

        .motor-score {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.875rem;
            color: var(--text);
        }
        .motor-item:first-child .motor-score { color: var(--lime); }

        .bar-bg {
            width: 80px;
            height: 4px;
            background: var(--dark-4);
            border-radius: 2px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 2px;
            background: var(--muted);
            transition: width 1s ease;
        }
        .motor-item:first-child .bar-fill { background: var(--lime); }

        .criteria-pills {
            margin-top: 16px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .pill {
            padding: 4px 10px;
            background: var(--dark-3);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            font-size: 0.72rem;
            color: var(--text-soft);
        }

        /* Floating card */
        .float-card {
            position: absolute;
            background: var(--dark-3);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 12px 16px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .float-card-1 {
            top: -70px;
            right: -20px;
            animation-delay: 0s;
        }
        .float-card-2 {
            bottom: -50px;
            left: -20px;
            animation-delay: 1.5s;
        }

        .float-label {
            font-size: 0.7rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 4px;
        }
        .float-value {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: var(--lime);
            font-size: 1rem;
        }


        /* ----- SECTION COMMONS ----- */
        .section {
            padding: 100px 24px;
        }
        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--lime);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 12px;
        }
        .section-title {
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.02em;
        }
        .section-sub {
            margin-top: 16px;
            font-size: 1rem;
            color: var(--text-soft);
            max-width: 560px;
            line-height: 1.7;
        }


        /* ----- FEATURES ----- */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 56px;
        }

        .feature-card {
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius);
            padding: 32px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(200,241,53,0) 50%, transparent);
            transition: all 0.3s;
        }

        .feature-card:hover {
            border-color: rgba(200,241,53,0.2);
            transform: translateY(-4px);
            box-shadow: 0 20px 48px rgba(0,0,0,0.3);
        }

        .feature-card:hover::before {
            background: linear-gradient(90deg, transparent, rgba(200,241,53,0.4), transparent);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(200,241,53,0.1);
            border: 1px solid rgba(200,241,53,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .feature-icon svg {
            width: 24px;
            height: 24px;
            color: var(--lime);
            stroke: var(--lime);
        }

        .feature-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 10px;
        }

        .feature-desc {
            font-size: 0.875rem;
            color: var(--text-soft);
            line-height: 1.7;
        }

        .feature-tag {
            display: inline-block;
            margin-top: 16px;
            padding: 3px 10px;
            background: var(--dark-3);
            border-radius: 20px;
            font-size: 0.72rem;
            color: var(--lime);
            font-weight: 600;
            border: 1px solid rgba(200,241,53,0.15);
        }

        /* Large feature card */
        .feature-card-lg {
            grid-column: span 2;
        }

        .feature-card-lg .feature-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .mcdm-methods {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .method-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: var(--dark-3);
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.04);
        }

        .method-name {
            font-family: 'Syne', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text);
        }

        .method-desc-sm {
            font-size: 0.72rem;
            color: var(--muted);
        }

        .method-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--lime);
        }


        /* ----- HOW IT WORKS ----- */
        .hiw-section {
            background: var(--dark-2);
            border-top: 1px solid rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: rgba(255,255,255,0.05);
            border-radius: var(--radius);
            overflow: hidden;
            margin-top: 56px;
        }

        .step {
            background: var(--dark-2);
            padding: 36px 28px;
            position: relative;
            transition: background 0.2s;
        }

        .step:hover { background: var(--dark-3); }

        .step-num {
            font-family: 'Syne', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: rgba(200,241,53,0.12);
            line-height: 1;
            margin-bottom: 16px;
        }

        .step-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(200,241,53,0.08);
            border: 1px solid rgba(200,241,53,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .step-icon svg {
            width: 20px;
            height: 20px;
            stroke: var(--lime);
        }

        .step-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 8px;
        }

        .step-desc {
            font-size: 0.85rem;
            color: var(--text-soft);
            line-height: 1.65;
        }


        /* ----- CRITERIA ----- */
        .criteria-section { }

        .criteria-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 56px;
        }

        .criteria-card {
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius);
            padding: 28px;
            display: flex;
            gap: 20px;
            align-items: flex-start;
            transition: all 0.25s ease;
        }

        .criteria-card:hover {
            border-color: rgba(200,241,53,0.15);
            transform: translateX(4px);
        }

        .criteria-num {
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            font-weight: 800;
            color: var(--lime);
            background: rgba(200,241,53,0.08);
            border: 1px solid rgba(200,241,53,0.2);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .criteria-content h4 {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 6px;
        }

        .criteria-content p {
            font-size: 0.85rem;
            color: var(--text-soft);
            line-height: 1.6;
        }

        .criteria-weight {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .weight-bar {
            flex: 1;
            height: 4px;
            background: var(--dark-4);
            border-radius: 2px;
            overflow: hidden;
        }

        .weight-fill {
            height: 100%;
            background: var(--lime);
            border-radius: 2px;
        }

        .weight-label {
            font-size: 0.72rem;
            color: var(--lime);
            font-weight: 700;
            font-family: 'Syne', sans-serif;
        }


        /* ----- CTA BANNER ----- */
        .cta-section {
            padding: 80px 24px;
        }

        .cta-box {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--dark-2);
            border: 1px solid rgba(200,241,53,0.2);
            border-radius: 24px;
            padding: 64px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .cta-box::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 300px;
            background: radial-gradient(ellipse, rgba(200,241,53,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.02em;
            max-width: 640px;
            margin: 0 auto 16px;
        }

        .cta-sub {
            font-size: 1rem;
            color: var(--text-soft);
            max-width: 480px;
            margin: 0 auto 36px;
            line-height: 1.7;
        }

        .cta-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }


        /* ----- ANIMATIONS ----- */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }


        /* ----- RESPONSIVE ----- */
        @media (max-width: 1024px) {
            .hero-inner { gap: 48px; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .feature-card-lg { grid-column: span 2; }
            .steps-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; gap: 48px; }
            .hero-visual { display: none; }
            .hero { padding: 100px 24px 60px; min-height: auto; }
            .features-grid { grid-template-columns: 1fr; }
            .feature-card-lg { grid-column: span 1; }
            .feature-card-lg .feature-body { grid-template-columns: 1fr; }
            .steps-grid { grid-template-columns: 1fr; }
            .criteria-grid { grid-template-columns: 1fr; }
            .cta-box { padding: 40px 24px; }
            .hero-stats { gap: 20px; }
        }
    </style>
    @endpush

    <!-- ===== HERO ===== -->
    <section class="hero">
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
                    Sistem Pendukung Keputusan menggunakan metode <strong style="color:var(--text)">MCDM (Multi-Criteria Decision Making)</strong> untuk menganalisis dan merekomendasikan motor listrik yang paling sesuai dengan kebutuhan dan anggaran Anda.
                </p>

                <div class="hero-actions">
                    <a href="#" class="btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/></svg>
                        Mulai Analisis Sekarang
                    </a>
                    <a href="#" class="btn-ghost">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
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
                        <span class="label">Metode MCDM</span>
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
                        <div class="motor-item">
                            <div class="motor-rank">1</div>
                            <div class="motor-info">
                                <div class="motor-name">Honda EM1 e:</div>
                                <div class="motor-brand">Honda • Rp 30,5 Jt</div>
                            </div>
                            <div class="motor-score-bar">
                                <div class="motor-score">0.847</div>
                                <div class="bar-bg"><div class="bar-fill" style="width:84.7%"></div></div>
                            </div>
                        </div>
                        <div class="motor-item">
                            <div class="motor-rank">2</div>
                            <div class="motor-info">
                                <div class="motor-name">Gesits G1</div>
                                <div class="motor-brand">Gesits • Rp 28,4 Jt</div>
                            </div>
                            <div class="motor-score-bar">
                                <div class="motor-score">0.762</div>
                                <div class="bar-bg"><div class="bar-fill" style="width:76.2%"></div></div>
                            </div>
                        </div>
                        <div class="motor-item">
                            <div class="motor-rank">3</div>
                            <div class="motor-info">
                                <div class="motor-name">Alva One</div>
                                <div class="motor-brand">Alva • Rp 27,9 Jt</div>
                            </div>
                            <div class="motor-score-bar">
                                <div class="motor-score">0.714</div>
                                <div class="bar-bg"><div class="bar-fill" style="width:71.4%"></div></div>
                            </div>
                        </div>
                        <div class="motor-item">
                            <div class="motor-rank">4</div>
                            <div class="motor-info">
                                <div class="motor-name">Polytron Fox-R</div>
                                <div class="motor-brand">Polytron • Rp 19,5 Jt</div>
                            </div>
                            <div class="motor-score-bar">
                                <div class="motor-score">0.651</div>
                                <div class="bar-bg"><div class="bar-fill" style="width:65.1%"></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="criteria-pills">
                        <span class="pill">Harga</span>
                        <span class="pill">Jarak Tempuh</span>
                        <span class="pill">Tenaga</span>
                        <span class="pill">Garansi</span>
                    </div>
                </div>

                <div class="float-card float-card-2">
                    <div class="float-label">Metode</div>
                    <div class="float-value" style="font-size:0.85rem">MCDM</div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== FEATURES ===== -->
    <section class="section" id="features">
        <div class="section-inner">
            <div class="section-label">Keunggulan Sistem</div>
            <h2 class="section-title">Analisis Cerdas, Keputusan Tepat</h2>
            <p class="section-sub">Platform kami mengintegrasikan metode MCDM terkemuka untuk memberikan rekomendasi yang objektif dan transparan.</p>

            <div class="features-grid">
                <div class="feature-card feature-card-lg">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div class="feature-title">Metode MCDM Multi-Pendekatan</div>
                    <div class="feature-desc">Sistem kami menggunakan 4 metode pembobotan MCDM yang telah teruji secara akademis untuk menghasilkan rekomendasi yang akurat dan dapat dipercaya.</div>
                    <div class="feature-body" style="margin-top:20px">
                        <div class="mcdm-methods">
                            <div class="method-row">
                                <div>
                                    <div class="method-name">EW-TOPSIS</div>
                                    <div class="method-desc-sm">Analytical Hierarchy Process</div>
                                </div>
                                <div class="method-indicator"></div>
                            </div>
                            <div class="method-row">
                                <div>
                                    <div class="method-name">RS-TOPSIS</div>
                                    <div class="method-desc-sm">Technique for Order Preference</div>
                                </div>
                                <div class="method-indicator"></div>
                            </div>
                            <div class="method-row">
                                <div>
                                    <div class="method-name">RR-TOPSIS</div>
                                    <div class="method-desc-sm">Simple Additive Weighting</div>
                                </div>
                                <div class="method-indicator"></div>
                            </div>
                            <div class="method-row">
                                <div>
                                    <div class="method-name">ROC-TOPSIS</div>
                                    <div class="method-desc-sm">Simple Additive Weighting</div>
                                </div>
                                <div class="method-indicator"></div>
                            </div>
                        </div>
                        <div>
                            <div class="feature-desc">Setiap metode memiliki karakteristik unik. AHP menentukan bobot kriteria, TOPSIS mencari solusi ideal, dan SAW memberikan skor agregat.</div>
                            <div class="feature-tag">4 Metode Pembobotan</div>
                        </div>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                    </div>
                    <div class="feature-title">Kriteria yang Komprehensif</div>
                    <div class="feature-desc">Evaluasi berdasarkan 5 kriteria utama: harga, jarak tempuh, waktu pengisian daya, kapasitas baterai, dan daya maksmum.</div>
                    <div class="feature-tag">5 Kriteria Penilaian</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>
                    </div>
                    <div class="feature-title">Hasil Real-time & Transparan</div>
                    <div class="feature-desc">Setiap langkah perhitungan ditampilkan secara transparan. Lihat matriks keputusan, normalisasi, dan skor akhir dengan jelas.</div>
                    <div class="feature-tag">Proses Transparan</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div class="feature-title">Preferensi yang Dapat Dikustomisasi</div>
                    <div class="feature-desc">Atur bobot kepentingan setiap kriteria sesuai prioritas Anda. Sistem menyesuaikan urutan rekomendasi berdasarkan input Anda.</div>
                    <div class="feature-tag">Personalisasi Penuh</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                    </div>
                    <div class="feature-title">Laporan & Perbandingan Detail</div>
                    <div class="feature-desc">Ekspor hasil analisis sebagai laporan, lakukan perbandingan side-by-side antara motor, dan visualisasikan data dengan grafik interaktif.</div>
                    <div class="feature-tag">Export PDF & Grafik</div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== HOW IT WORKS ===== -->
    <section class="section hiw-section" id="how-it-works">
        <div class="section-inner">
            <div class="section-label">Alur Penggunaan</div>
            <h2 class="section-title">Empat Langkah Sederhana</h2>
            <p class="section-sub">Dari input preferensi hingga mendapatkan rekomendasi motor listrik terbaik, hanya dalam beberapa menit.</p>

            <div class="steps-grid">
                <div class="step">
                    <div class="step-num">01</div>
                    <div class="step-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div class="step-title">Tentukan Profil & Kebutuhan</div>
                    <p class="step-desc">Isi formulir singkat mengenai kebutuhan harian, anggaran, dan preferensi fitur motor listrik yang Anda inginkan.</p>
                </div>
                <div class="step">
                    <div class="step-num">02</div>
                    <div class="step-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <div class="step-title">Atur Bobot Kriteria</div>
                    <p class="step-desc">Tentukan tingkat kepentingan setiap kriteria menggunakan perbandingan berpasangan metode AHP. Sistem panduan interaktif tersedia.</p>
                </div>
                <div class="step">
                    <div class="step-num">03</div>
                    <div class="step-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <div class="step-title">Proses Analisis MCDM</div>
                    <p class="step-desc">Sistem secara otomatis menjalankan algoritma TOPSIS, menormalisasi data, dan menghitung skor preferensi setiap alternatif.</p>
                </div>
                <div class="step">
                    <div class="step-num">04</div>
                    <div class="step-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-title">Terima Rekomendasi</div>
                    <p class="step-desc">Dapatkan daftar rekomendasi motor listrik terurut lengkap dengan skor, penjelasan, dan perbandingan detail untuk mendukung keputusan Anda.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== CRITERIA ===== -->
    <section class="section criteria-section" id="criteria">
        <div class="section-inner">
            <div class="section-label">Parameter Evaluasi</div>
            <h2 class="section-title">5 Kriteria Penilaian Utama</h2>
            <p class="section-sub">Setiap motor listrik dievaluasi secara menyeluruh menggunakan kriteria yang relevan dan terukur.</p>

            <div class="criteria-grid">
                <div class="criteria-card">
                    <div class="criteria-num">C1</div>
                    <div class="criteria-content">
                        <h4>Harga Jual</h4>
                        <p>Harga jual resmi motor listrik di pasar Indonesia, termasuk subsidi pemerintah yang berlaku.</p>
                        <div class="criteria-weight">
                            <div class="weight-bar"><div class="weight-fill" style="width:85%"></div></div>
                            <span class="weight-label">Bobot Tinggi</span>
                        </div>
                    </div>
                </div>
                <div class="criteria-card">
                    <div class="criteria-num">C2</div>
                    <div class="criteria-content">
                        <h4>Jarak Tempuh per Pengisian</h4>
                        <p>Jarak maksimal yang dapat ditempuh dalam sekali pengisian baterai penuh dalam kondisi normal.</p>
                        <div class="criteria-weight">
                            <div class="weight-bar"><div class="weight-fill" style="width:80%"></div></div>
                            <span class="weight-label">Bobot Tinggi</span>
                        </div>
                    </div>
                </div>
                <div class="criteria-card">
                    <div class="criteria-num">C3</div>
                    <div class="criteria-content">
                        <h4>Waktu Pengisian Daya (min)</h4>
                        <p>Kapasitas penyimpanan energi baterai yang mempengaruhi jarak tempuh dan durasi pengisian daya.</p>
                        <div class="criteria-weight">
                            <div class="weight-bar"><div class="weight-fill" style="width:65%"></div></div>
                            <span class="weight-label">Bobot Sedang</span>
                        </div>
                    </div>
                </div>
                <div class="criteria-card">
                    <div class="criteria-num">C4</div>
                    <div class="criteria-content">
                        <h4>Kapasitas Baterai(kWh)</h4>
                        <p>Kapasitas penyimpanan energi baterai yang mempengaruhi jarak tempuh dan durasi pengisian daya.</p>
                        <div class="criteria-weight">
                            <div class="weight-bar"><div class="weight-fill" style="width:60%"></div></div>
                            <span class="weight-label">Bobot Sedang</span>
                        </div>
                    </div>
                </div>
                <div class="criteria-card">
                    <div class="criteria-num">C5</div>
                    <div class="criteria-content">
                        <h4>Daya Maksimum Motor (kW)</h4>
                        <p>Garansi resmi yang diberikan produsen mencakup baterai, motor, dan komponen utama lainnya.</p>
                        <div class="criteria-weight">
                            <div class="weight-bar"><div class="weight-fill" style="width:55%"></div></div>
                            <span class="weight-label">Bobot Sedang</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


    <!-- ===== CTA ===== -->
    <section class="cta-section">
        <div class="cta-box">
            <div class="hero-label" style="justify-content:center; display:inline-flex; margin-bottom:20px">
                <div class="pulse-dot"></div>
                Siap Memilih?
            </div>
            <h2 class="cta-title">Mulai Analisis Motor Listrik Anda Sekarang</h2>
            <p class="cta-sub">Gratis, tanpa registrasi, hasil langsung tersedia. Dapatkan rekomendasi personal berdasarkan kebutuhan spesifik Anda.</p>
            <div class="cta-actions">
                <a href="#" class="btn-primary" style="font-size:1rem; padding:16px 32px">
                    <svg style="width:20px;height:20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/></svg>
                    Mulai Analisis — Gratis
                </a>
                <a href="#" class="btn-ghost">
                    Pelajari Metodologi
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>