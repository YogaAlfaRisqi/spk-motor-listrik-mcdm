<style>
/* ===== NAVBAR ===== */
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

.nav-inner::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(200, 241, 53, 0.2), transparent);
}

.nav-bg {
    position: absolute;
    inset: 0;
    background: rgba(10, 12, 15, 0.85);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    z-index: -1;
}

/* Logo */
.nav-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    cursor: pointer;
}

.logo-icon {
    width: 38px;
    height: 38px;
    background: var(--lime);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.logo-icon svg {
    width: 22px;
    height: 22px;
}

.logo-text {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.2rem;
    color: var(--white);
    letter-spacing: -0.02em;
}

.logo-text span {
    color: var(--lime);
}

/* Nav Links */
.nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
    list-style: none;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: var(--radius-sm);
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-soft);
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    background: none;
    white-space: nowrap;
}

.nav-link:hover {
    color: var(--text);
    background: var(--dark-3);
    border-color: rgba(255,255,255,0.06);
}

.nav-link.active {
    color: var(--lime);
    background: rgba(200, 241, 53, 0.08);
    border-color: rgba(200, 241, 53, 0.2);
}

.nav-link svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

/* CTA Button */
.nav-cta {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--lime);
    color: var(--dark);
    border-radius: var(--radius-sm);
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
    text-decoration: none;
}

.nav-cta:hover {
    background: var(--lime-dark);
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(200, 241, 53, 0.25);
}

.nav-cta svg { width: 16px; height: 16px; }

/* Mobile Hamburger */
.nav-hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: 8px;
    background: none;
    border: none;
}

.nav-hamburger span {
    display: block;
    width: 24px;
    height: 2px;
    background: var(--text);
    border-radius: 2px;
    transition: all 0.3s ease;
}

/* Mobile Menu */
.nav-mobile {
    position: absolute;
    top: calc(100% + 8px);
    left: 24px;
    right: 24px;
    background: var(--dark-2);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--radius);
    padding: 8px;
    display: none;
    flex-direction: column;
    gap: 4px;
    animation: slideDown 0.2s ease forwards;
    z-index: 999;
}

.nav-mobile.open { display: flex; }
@keyframes slideDown { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

.nav-mobile .nav-link { width: 100%; justify-content: flex-start; padding: 12px 16px; }
.nav-mobile .nav-cta { margin-top: 4px; justify-content: center; }

@media (max-width: 768px) {
    .nav-links, .nav-cta { display: none; }
    .nav-hamburger { display: flex; }
}
</style>

<nav class="nav-wrapper" x-data>
    <div class="nav-bg"></div>
    <div class="nav-inner">
        {{-- Logo --}}
        <div class="nav-logo" wire:click="navigate('home')">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" fill="#0A0C0F" stroke="#0A0C0F" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="logo-text">SPK<span>Motor Listrik</span></span>
        </div>

        {{-- Desktop Nav --}}
        <ul class="nav-links">
            <li>
                <button class="nav-link {{ $currentPage === 'home' ? 'active' : '' }}" wire:click="navigate('home')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Beranda
                </button>
            </li>
            <li>
                <button class="nav-link {{ $currentPage === 'how-it-works' ? 'active' : '' }}" wire:click="navigate('how-it-works')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    Cara Kerja
                </button>
            </li>
            <li>
                <button class="nav-link {{ $currentPage === 'about' ? 'active' : '' }}" wire:click="navigate('about')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Tentang
                </button>
            </li>
            <li>
                <button class="nav-link {{ $currentPage === 'about' ? 'active' : '' }}" wire:click="navigate('about')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Motor
                </button>
            </li>
        </ul>

        {{-- CTA --}}
        <button class="nav-cta" wire:click="navigate('recommendation')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/></svg>
            Mulai Analisis
        </button>

        {{-- Mobile Hamburger --}}
        <button class="nav-hamburger" wire:click="toggleMobile" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div class="nav-mobile {{ $mobileOpen ? 'open' : '' }}">
        <button class="nav-link {{ $currentPage === 'home' ? 'active' : '' }}" wire:click="navigate('home')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg> Beranda
        </button>
        <button class="nav-link {{ $currentPage === 'how-it-works' ? 'active' : '' }}" wire:click="navigate('how-it-works')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> Cara Kerja
        </button>
        <button class="nav-link {{ $currentPage === 'about' ? 'active' : '' }}" wire:click="navigate('about')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg> Tentang
        </button>
        <button class="nav-cta" wire:click="navigate('recommendation')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/></svg>
            Mulai Analisis
        </button>
    </div>
</nav>