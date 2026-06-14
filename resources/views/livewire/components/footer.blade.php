<style>
/* ===== FOOTER ===== */
.footer {
    background: var(--dark-2);
    border-top: 1px solid rgba(255,255,255,0.06);
    padding: 60px 24px 32px;
    margin-top: 80px;
}

.footer-inner {
    max-width: 1200px;
    margin: 0 auto;
}

.footer-top {
    display: grid;
    grid-template-columns: 1.4fr 1fr 1fr 1fr;
    gap: 48px;
    padding-bottom: 48px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.footer-brand .logo-text {
    font-family: 'Syne', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--white);
}
.footer-brand .logo-text span { color: var(--lime); }

.footer-desc {
    margin-top: 12px;
    color: var(--text-soft);
    font-size: 0.875rem;
    line-height: 1.7;
    max-width: 280px;
}

.footer-badge {
    margin-top: 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(200,241,53,0.08);
    border: 1px solid rgba(200,241,53,0.2);
    border-radius: 20px;
    padding: 6px 12px;
    font-size: 0.75rem;
    color: var(--lime);
    font-weight: 500;
}

.footer-col h4 {
    font-family: 'Syne', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 16px;
}

.footer-links {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.footer-links a {
    color: var(--text-soft);
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s;
}

.footer-links a:hover { color: var(--lime); }

.footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 28px;
    flex-wrap: wrap;
    gap: 12px;
}

.footer-copy {
    color: var(--muted);
    font-size: 0.8rem;
}

.footer-method {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    color: var(--muted);
}

.method-tag {
    background: var(--dark-3);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--lime);
    font-family: 'Syne', sans-serif;
    letter-spacing: 0.05em;
}

@media (max-width: 768px) {
    .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
    .footer-bottom { flex-direction: column; text-align: center; }
}
@media (max-width: 480px) {
    .footer-top { grid-template-columns: 1fr; }
}
</style>

<footer class="footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="logo-text">Electro<span>Choice</span></div>
                <p class="footer-desc">
                    Sistem pendukung keputusan cerdas untuk membantu Anda memilih motor listrik terbaik berdasarkan kebutuhan dan preferensi Anda.
                </p>
                <div class="footer-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/></svg>
                    Powered by MCDM
                </div>
            </div>

            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Cara Kerja</a></li>
                    <li><a href="#">Mulai Analisis</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Metode</h4>
                <ul class="footer-links">
                    <li><a href="#">AHP</a></li>
                    <li><a href="#">TOPSIS</a></li>
                    <li><a href="#">SAW</a></li>
                    <li><a href="#">VIKOR</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Informasi</h4>
                <ul class="footer-links">
                    <li><a href="#">Panduan Penggunaan</a></li>
                    <li><a href="#">Kriteria Penilaian</a></li>
                    <li><a href="#">Daftar Motor Listrik</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">© 2025 ElectroChoice. Sistem Pendukung Keputusan Rekomendasi Motor Listrik.</p>
            <div class="footer-method">
                Menggunakan metode
                <span class="method-tag">MCDM</span>
                <span class="method-tag">AHP</span>
                <span class="method-tag">TOPSIS</span>
            </div>
        </div>
    </div>
</footer>