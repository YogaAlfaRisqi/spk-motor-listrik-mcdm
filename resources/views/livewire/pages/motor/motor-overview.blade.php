<div class="relative">
    <div class="pt-[120px] min-h-screen bg-[#0A0C0F] text-white">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pb-48">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- partials for sidebar -->
                @include('livewire.pages.motor.partials.sidebar')
                <main class="lg:col-span-9">
                    <!-- Grid motor for content -->
                    <div id="motorGrid" class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-5 lg:gap-6"></div>
                    <!-- pagination -->
                    <div id="pagination" class="flex items-center justify-center gap-2 mt-8 flex-wrap"></div>
                </main>
            </div>
        </div>
    </div>
    <!-- Floating Bar -->
    <div
        id="spkBar"
        class="fixed bottom-4 left-1/2 z-50"
        style="
            transform: translateX(-50%) translateY(140px);
            width: 94%;
            max-width: 720px;
            opacity: 0;
            transition: transform .45s cubic-bezier(.34,1.3,.64,1), opacity .3s;
            pointer-events: none;
        ">
        <div class="bg-[#14161A] border border-[#C8F135]/30 rounded-2xl p-3 flex flex-col gap-3">

            {{-- Top row --}}
            <div class="flex items-center justify-between px-1">
                <p class="text-[11px] font-bold text-white/60">
                    <span id="countMotor" class="text-[#C8F135]">0</span> motor dipilih
                </p>
                <div class="flex items-center gap-2">
                    <button
                        onclick="clearSelection()"
                        class="text-[10px] font-semibold text-white/40 hover:text-white border border-white/10 hover:border-white/25 px-3 py-1.5 rounded-full transition">Hapus semua</button>
                    <button
                        onclick="prosesPerbandingan()"
                        class="text-[10px] font-extrabold tracking-wide bg-[#C8F135] text-black px-4 py-1.5 rounded-full hover:bg-[#d9f540] transition">Bandingkan</button>
                </div>
            </div>

            {{-- Scroll row --}}
            <div class="relative" id="scrollOuter">
                <button id="btnLeft" onclick="slideBar(-1)" aria-label="Geser kiri"
                    class="scroll-arrow hidden absolute left-0 top-1/2 -translate-y-1/2 z-10
                           w-7 h-7 flex items-center justify-center shrink-0
                           bg-[#1e2126] border border-[#C8F135]/30 rounded-full
                           text-[#C8F135] text-sm font-bold hover:bg-[#C8F135]/15 transition">‹</button>

                <div id="fadeLeft" class="hidden absolute left-0 top-0 bottom-0 w-9 pointer-events-none z-[1]"
                    style="background:linear-gradient(to right,#14161A,transparent)"></div>

                <div id="barItems" class="flex gap-2 overflow-x-auto px-1 py-1"
                    style="-ms-overflow-style:none;scrollbar-width:none;cursor:grab;"></div>

                <div id="fadeRight" class="hidden absolute right-0 top-0 bottom-0 w-9 pointer-events-none z-[1]"
                    style="background:linear-gradient(to left,#14161A,transparent)"></div>

                <button id="btnRight" onclick="slideBar(1)" aria-label="Geser kanan"
                    class="scroll-arrow hidden absolute right-0 top-1/2 -translate-y-1/2 z-10
                           w-7 h-7 flex items-center justify-center shrink-0
                           bg-[#1e2126] border border-[#C8F135]/30 rounded-full
                           text-[#C8F135] text-sm font-bold hover:bg-[#C8F135]/15 transition">›</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    /* ── scrollbar hide ── */
    #barItems::-webkit-scrollbar {
        display: none;
    }

    /* ── card states ── */
    .motor-card {
        transition: border-color .2s;
    }

    .motor-card:hover {
        border-color: rgba(200, 241, 53, .3);
    }

    .motor-card.is-selected {
        border-color: rgba(200, 241, 53, .6) !important;
    }

    .motor-card.is-selected .card-name {
        color: #C8F135;
    }

    .motor-card.is-selected .btn-compare {
        background: #C8F135;
        color: #000;
        border-color: #C8F135;
    }

    /* ── pagination button ── */
    .pg-btn {
        min-width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid rgba(255, 255, 255, .08);
        background: #14161A;
        color: rgba(255, 255, 255, .5);
        cursor: pointer;
        transition: all .15s;
        padding: 0 8px;
    }

    .pg-btn:hover {
        border-color: rgba(200, 241, 53, .4);
        color: #C8F135;
    }

    .pg-btn.active {
        background: #C8F135;
        color: #000;
        border-color: #C8F135;
    }

    .pg-btn:disabled {
        opacity: .3;
        cursor: default;
        pointer-events: none;
    }

    .pg-dots {
        color: rgba(255, 255, 255, .25);
        font-size: 12px;
        padding: 0 4px;
    }

    /* ── chip ── */
    .bar-chip {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, .04);
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 12px;
        padding: 5px 24px 5px 5px;
        min-width: 152px;
        max-width: 180px;
        position: relative;
    }

    .bar-chip img {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .bar-chip-info {
        flex: 1;
        min-width: 0;
    }

    .bar-chip-name {
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #fff;
    }

    .bar-chip-price {
        font-size: 9px;
        color: #C8F135;
        font-weight: 600;
        margin-top: 2px;
    }

    .bar-chip-remove {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 16px;
        height: 16px;
        background: #ef4444;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        color: #fff;
        font-size: 9px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s;
    }

    .bar-chip-remove:hover {
        background: #dc2626;
    }

    /* ── mobile card compact ── */
    @media (max-width: 639px) {
        .card-body-pad {
            padding: 12px !important;
        }

        .card-title {
            font-size: 13px !important;
        }

        .card-price-txt {
            font-size: 12px !important;
            margin-bottom: 10px !important;
        }

        .spec-box {
            padding: 6px 8px !important;
        }

        .spec-label-txt {
            font-size: 7px !important;
        }

        .spec-val-txt {
            font-size: 10px !important;
        }

        .btn-compare {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
            font-size: 9px !important;
        }
    }
</style>

<script>
    (function() {
        /* ─────────────── DATA (dari PHP via JSON) ─────────────── */
        const ALL_MOTORS = @json($motors);
        const PER_PAGE = 6;
        let currentPage = 1;
        let selected = [];

        /* ─────────────── RENDER GRID ─────────────── */
        function renderGrid() {
            const start = (currentPage - 1) * PER_PAGE;
            const slice = ALL_MOTORS.slice(start, start + PER_PAGE);
            const grid = document.getElementById('motorGrid');

            grid.innerHTML = slice.map(m => {
                const sel = selected.includes(m.id_motor);
                return `
            <div
                id="card-${m.id_motor}"
                class="motor-card${sel ? ' is-selected' : ''} flex flex-col bg-[#14161A] border border-white/5 rounded-2xl overflow-hidden group"
                data-id="${m.id_motor}" data-name="${m.nama_motor}" data-price="${m.harga}" data-img="${m.img}"
            >
                <div class="aspect-square bg-[#1a1d23] overflow-hidden">
                    <img src="${m.img}" alt="${m.nama_motor}"
                         class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition duration-700"
                         loading="lazy">
                </div>
                <div class="card-body-pad p-4 sm:p-5 flex flex-col flex-1">
                    <h3 class="card-name card-title font-syne font-bold text-base sm:text-lg mb-1 group-hover:text-[#C8F135] transition">
                        ${m.nama_motor}
                    </h3>
                    <p class="card-price-txt text-[#C8F135] font-black text-sm sm:text-base mb-4 font-syne">
                        ${m.harga}
                    </p>
                    <div class="grid grid-cols-2 gap-1.5 mb-4">
                        <div class="spec-box bg-[#0A0C0F] p-2.5 rounded-xl border border-white/5">
                            <p class="spec-label-txt text-[7px] sm:text-[8px] text-gray-500 uppercase font-bold mb-0.5">Jarak</p>
                            <p class="spec-val-txt text-[10px] sm:text-xs font-bold">${m.jarak_tempuh}</p>
                        </div>
                        <div class="spec-box bg-[#0A0C0F] p-2.5 rounded-xl border border-white/5">
                            <p class="spec-label-txt text-[7px] sm:text-[8px] text-gray-500 uppercase font-bold mb-0.5">Top Speed</p>
                            <p class="spec-val-txt text-[10px] sm:text-xs font-bold">${m.daya_maksimum}</p>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <button
                            id="btn-${m.id_motor}"
                            onclick="toggleMotor(${m.id_motor})"
                            class="btn-compare w-full py-2.5 border border-[#C8F135]/50 text-[#C8F135] rounded-xl font-bold text-[9px] sm:text-[10px] uppercase tracking-widest hover:bg-[#C8F135] hover:text-black transition flex items-center justify-center gap-1.5
                                   ${sel ? 'bg-[#C8F135] !text-black !border-[#C8F135]' : ''}"
                        >
                            ${sel
                                ? '<span class="text-sm">✓</span> Terpilih'
                                : '<span class="text-base">+</span> Bandingkan'}
                        </button>
                    </div>
                </div>
            </div>`;
            }).join('');

            renderPagination();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ─────────────── PAGINATION ─────────────── */
        function renderPagination() {
            const total = Math.ceil(ALL_MOTORS.length / PER_PAGE);
            if (total <= 1) {
                document.getElementById('pagination').innerHTML = '';
                return;
            }

            const p = currentPage;
            let html = '';

            /* prev */
            html += `<button class="pg-btn" onclick="goPage(${p-1})" ${p===1?'disabled':''}>‹</button>`;

            /* page numbers with ellipsis */
            const pages = buildPageRange(p, total);
            pages.forEach(n => {
                if (n === '...') {
                    html += `<span class="pg-dots">···</span>`;
                } else {
                    html += `<button class="pg-btn${n===p?' active':''}" onclick="goPage(${n})">${n}</button>`;
                }
            });

            /* next */
            html += `<button class="pg-btn" onclick="goPage(${p+1})" ${p===total?'disabled':''}>›</button>`;

            document.getElementById('pagination').innerHTML = html;
        }

        function buildPageRange(current, total) {
            if (total <= 7) return Array.from({
                length: total
            }, (_, i) => i + 1);
            const r = [];
            if (current <= 4) {
                r.push(1, 2, 3, 4, 5, '...', total);
            } else if (current >= total - 3) {
                r.push(1, '...', total - 4, total - 3, total - 2, total - 1, total);
            } else {
                r.push(1, '...', current - 1, current, current + 1, '...', total);
            }
            return r;
        }

        window.goPage = function(n) {
            const total = Math.ceil(ALL_MOTORS.length / PER_PAGE);
            if (n < 1 || n > total) return;
            currentPage = n;
            renderGrid();
        };

        /* ─────────────── TOGGLE / SELECT ─────────────── */
        window.toggleMotor = function(id) {
            selected.includes(id) ?
                (selected = selected.filter(x => x !== id)) :
                selected.push(id);
            syncCard(id);
            renderBar();
        };

        window.removeMotor = function(id) {
            selected = selected.filter(x => x !== id);
            syncCard(id);
            renderBar();
        };

        window.clearSelection = function() {
            const prev = [...selected];
            selected = [];
            prev.forEach(syncCard);
            renderBar();
        };

        window.prosesPerbandingan = function() {
            if (selected.length < 2) {
                alert('Pilih minimal 2 motor untuk dibandingkan.');
                return;
            }
            window.location.href = '/motor/compare?' + selected.map(id => `ids[]=${id}`).join('&');
        };

        function syncCard(id) {
            const card = document.getElementById(`card-${id}`);
            const btn = document.getElementById(`btn-${id}`);
            if (!card || !btn) return;
            const on = selected.includes(id);
            card.classList.toggle('is-selected', on);
            if (on) {
                btn.classList.add('bg-[#C8F135]', '!text-black', '!border-[#C8F135]');
                btn.innerHTML = '<span class="text-sm">✓</span> Terpilih';
            } else {
                btn.classList.remove('bg-[#C8F135]', '!text-black', '!border-[#C8F135]');
                btn.innerHTML = '<span class="text-base">+</span> Bandingkan';
            }
        }

        /* ─────────────── FLOATING BAR ─────────────── */
        function renderBar() {
            const bar = document.getElementById('spkBar');
            const barItems = document.getElementById('barItems');
            document.getElementById('countMotor').textContent = selected.length;

            if (selected.length === 0) {
                bar.style.transform = 'translateX(-50%) translateY(140px)';
                bar.style.opacity = '0';
                bar.style.pointerEvents = 'none';
            } else {
                bar.style.transform = 'translateX(-50%) translateY(0)';
                bar.style.opacity = '1';
                bar.style.pointerEvents = 'auto';
            }

            barItems.innerHTML = selected.map(id => {
                const m = ALL_MOTORS.find(x => x.id_motor === id);
                if (!m) return '';
                return `
                <div class="bar-chip">
                    <img src="${m.img}" alt="${m.nama_motor}">
                    <div class="bar-chip-info">
                        <div class="bar-chip-name">${m.nama_motor}</div>
                        <div class="bar-chip-price">${m.harga}</div>
                    </div>
                    <button class="bar-chip-remove" onclick="removeMotor(${id})" aria-label="Hapus ${m.nama_motor}">✕</button>
                </div>`;
            }).join('');

            requestAnimationFrame(syncScrollUI);
        }

        /* ─────────────── SCROLL ARROWS ─────────────── */
        function syncScrollUI() {
            const el = document.getElementById('barItems');
            const btnL = document.getElementById('btnLeft');
            const btnR = document.getElementById('btnRight');
            const fL = document.getElementById('fadeLeft');
            const fR = document.getElementById('fadeRight');
            if (!el) return;
            const over = el.scrollWidth > el.clientWidth + 2;
            const atStart = el.scrollLeft <= 2;
            const atEnd = el.scrollLeft + el.clientWidth >= el.scrollWidth - 2;
            const tog = (n, v) => n.classList.toggle('hidden', !v);
            tog(btnL, over && !atStart);
            tog(btnR, over && !atEnd);
            tog(fL, over && !atStart);
            tog(fR, over && !atEnd);
        }

        window.slideBar = function(dir) {
            document.getElementById('barItems').scrollBy({
                left: dir * 180,
                behavior: 'smooth'
            });
        };

        /* drag-to-scroll */
        const barItems = document.getElementById('barItems');
        let drag = false,
            sx = 0,
            ss = 0;
        barItems.addEventListener('mousedown', e => {
            drag = true;
            sx = e.pageX;
            ss = barItems.scrollLeft;
            barItems.style.cursor = 'grabbing';
            e.preventDefault();
        });
        document.addEventListener('mousemove', e => {
            if (drag) barItems.scrollLeft = ss - (e.pageX - sx);
        });
        document.addEventListener('mouseup', () => {
            drag = false;
            barItems.style.cursor = 'grab';
        });
        barItems.addEventListener('scroll', syncScrollUI);
        window.addEventListener('resize', syncScrollUI);

        /* ─────────────── INIT ─────────────── */
        renderGrid();
    })();
</script>
@endpush