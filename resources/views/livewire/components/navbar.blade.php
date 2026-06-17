<style>
    /* ===== NAVBAR CSS ===== */
    .nav-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 0 24px;
    }

    .nav-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        position: relative;
    }

    .nav-bg {
        position: absolute;
        inset: 0;
        background: rgba(10, 12, 15, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        z-index: -1;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .logo-icon {
        width: 38px;
        height: 38px;
        background: #C8F135;
        /* var(--lime) fallback */
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-text {
        font-weight: 800;
        font-size: 1.2rem;
        color: #FFFFFF;
        font-family: 'Syne', sans-serif;
    }

    .logo-text span {
        color: #C8F135;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-link {
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #A0A0A0;
        transition: all 0.2s ease;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #FFFFFF;
        background: rgba(255, 255, 255, 0.05);
    }

    .nav-link.active {
        color: #C8F135;
        background: rgba(200, 241, 53, 0.1);
    }

    .nav-cta {
        background: #C8F135;
        color: #0A0C0F;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Mobile Hamburger */
    .nav-hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
    }

    .nav-hamburger span {
        width: 24px;
        height: 2px;
        background: white;
        transition: 0.3s;
    }

    .nav-mobile {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #14161A;
        padding: 20px;
        flex-direction: column;
        gap: 15px;
    }

    .nav-mobile.active {
        display: flex;
    }

    @media (max-width: 768px) {

        .nav-links,
        .nav-cta.desktop-only {
            display: none;
        }

        .nav-hamburger {
            display: flex;
        }
    }
</style>

<nav class="nav-wrapper">
    <div class="nav-bg"></div>
    <div class="nav-inner">
        {{-- Logo --}}
        <a href="/" class="nav-logo">
            <div class="logo-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" fill="#0A0C0F" stroke="#0A0C0F" stroke-width="1.5" stroke-linejoin="round" />
                </svg>
            </div>
            <span class="logo-text">SPK<span>Motor Listrik</span></span>
        </a>

        {{-- Desktop Nav --}}
        <ul class="nav-links">
            <li><a href="/">Beranda</a></li>
            <li><a href="#how-it-works" class="nav-link {{ request()->is('how-it-works*') ? 'active' : '' }}">Cara Kerja</a></li>
            <li><a href="#about" class="nav-link {{ request()->is('about*') ? 'active' : '' }}">Tentang</a></li>
            <li>
                <a href="{{ route('motor-overview') }}"
                    class="nav-link {{ request()->routeIs('motor-overview') ? 'active' : '' }}">
                    Motor
                </a>
            </li>
        </ul>

        {{-- CTA --}}
        <a href="{{ route('motor-overview') }}" class="nav-cta desktop-only">
            Mulai Analisis
        </a>

        {{-- Hamburger --}}
        <button class="nav-hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div class="nav-mobile" id="mobileMenu">
        <a href="/" class="nav-link">Beranda</a>
        <a href="#how-it-works" class="nav-link">Cara Kerja</a>
        <a href="#tentang" class="nav-link">Tentang</a>
        <a href="{{ route('motor-overview') }}" class="nav-link">Motor</a>
        <a href="{{ route('motor-overview') }}" class="nav-cta">Mulai Analisis</a>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('active');
    }
</script>