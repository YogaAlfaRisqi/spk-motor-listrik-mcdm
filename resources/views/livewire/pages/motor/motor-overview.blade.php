<div class="relative">
    @include('livewire.pages.motor.partials.hero')

    <div class="pt-10 min-h-screen bg-[#0A0C0F] text-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 pb-48">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Sidebar filter --}}
                @include('livewire.pages.motor.partials.sidebar')

                <main class="lg:col-span-9">

                    {{-- Grid motor --}}
                    <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-5 lg:gap-6">
                        @forelse ($motors as $m)
                        <div
                            id="card-{{ $m->id_motor }}"
                            class="motor-card flex flex-col bg-[#14161A] border border-white/5 rounded-2xl overflow-hidden group"
                            data-id="{{ $m->id_motor }}">
                            {{-- Gambar --}}
                            <img
                                src="{{ $m->image ? asset('storage/' . $m->image) : asset('images/404 image.png') }}"
                                alt="{{ $m->nama_motor }}"
                                class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition duration-700"
                                loading="lazy">

                            {{-- Body --}}
                            <div class="card-body-pad p-4 sm:p-5 flex flex-col flex-1">
                                <h3 class="card-name font-syne font-bold text-base sm:text-lg mb-1 group-hover:text-[#C8F135] transition">
                                    {{ $m->nama_motor }}
                                </h3>

                                <p class="text-[#C8F135] font-black text-sm sm:text-base mb-4 font-syne">
                                    {{ $m->harga }}
                                </p>

                                <div class="grid grid-cols-2 gap-1.5 mb-4">
                                    <div class="spec-box bg-[#0A0C0F] p-2.5 rounded-xl border border-white/5">
                                        <p class="text-[7px] sm:text-[8px] text-gray-500 uppercase font-bold mb-0.5">Jarak</p>
                                        <p class="text-[10px] sm:text-xs font-bold">{{ $m->jarak_tempuh }}</p>
                                    </div>
                                    <div class="spec-box bg-[#0A0C0F] p-2.5 rounded-xl border border-white/5">
                                        <p class="text-[7px] sm:text-[8px] text-gray-500 uppercase font-bold mb-0.5">Top Speed</p>
                                        <p class="text-[10px] sm:text-xs font-bold">{{ $m->daya_maksimum }}</p>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <button
                                        id="btn-{{ $m->id_motor }}"
                                        onclick="toggleMotor({{ $m->id_motor }}, '{{ addslashes($m->nama_motor) }}', '{{ addslashes($m->harga) }}', '{{ $m->image ? asset('storage/' . $m->image) : asset('images/404 image.png') }}')"
                                        class="btn-compare w-full py-2.5 border border-[#C8F135]/50 text-[#C8F135] rounded-xl font-bold text-[9px] sm:text-[10px] uppercase tracking-widest hover:bg-[#C8F135] hover:text-black transition flex items-center justify-center gap-1.5">
                                        <span class="text-base">+</span> Bandingkan
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-2 xl:col-span-3 flex flex-col items-center justify-center py-24 text-center">
                            <div class="text-5xl mb-4">🔍</div>
                            <p class="font-syne font-bold text-white text-lg mb-2">Motor tidak ditemukan</p>
                            <p class="text-gray-500 text-sm">Coba ubah filter pencarian kamu.</p>
                        </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    {{ $motors->links('livewire.pages.motor.partials.pagination') }}

                </main>
            </div>
        </div>
    </div>

    {{-- Floating Bar --}}
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
                        class="text-[10px] font-semibold text-white/40 hover:text-white border border-white/10 hover:border-white/25 px-3 py-1.5 rounded-full transition">
                        Hapus semua
                    </button>
                    <button
                        onclick="prosesPerbandingan()"
                        class="text-[10px] font-extrabold tracking-wide bg-[#C8F135] text-black px-4 py-1.5 rounded-full hover:bg-[#d9f540] transition">
                        Bandingkan
                    </button>
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

        .card-name {
            font-size: 13px !important;
        }

        .spec-box {
            padding: 6px 8px !important;
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
        /* ─── STATE ─── */
        // map: id_motor (Number) → { name, price, img }
        const selected = new Map();

        /* ─── TOGGLE ─── */
        window.toggleMotor = function(id, name, price, img) {
            if (selected.has(id)) {
                selected.delete(id);
            } else {
                selected.set(id, {
                    name,
                    price,
                    img
                });
            }
            syncCard(id);
            renderBar();
        };

        window.removeMotor = function(id) {
            selected.delete(id);
            syncCard(id);
            renderBar();
        };

        window.clearSelection = function() {
            const ids = [...selected.keys()];
            selected.clear();
            ids.forEach(syncCard);
            renderBar();
        };

        window.prosesPerbandingan = function() {
            if (selected.size < 2) {
                alert('Pilih minimal 2 motor untuk dibandingkan.');
                return;
            }
            const qs = [...selected.keys()].map(id => `ids[]=${id}`).join('&');
            window.location.href = '/motor/compare?' + qs;
        };

        /* ─── SYNC CARD DOM ─── */
        function syncCard(id) {
            const card = document.getElementById(`card-${id}`);
            const btn = document.getElementById(`btn-${id}`);
            if (!card || !btn) return;

            const on = selected.has(id);
            card.classList.toggle('is-selected', on);

            if (on) {
                btn.innerHTML = '<span class="text-sm">✓</span> Terpilih';
            } else {
                btn.innerHTML = '<span class="text-base">+</span> Bandingkan';
            }
        }

        /* ─── FLOATING BAR ─── */
        function renderBar() {
            const bar = document.getElementById('spkBar');
            const barItems = document.getElementById('barItems');
            document.getElementById('countMotor').textContent = selected.size;

            if (selected.size === 0) {
                bar.style.transform = 'translateX(-50%) translateY(140px)';
                bar.style.opacity = '0';
                bar.style.pointerEvents = 'none';
            } else {
                bar.style.transform = 'translateX(-50%) translateY(0)';
                bar.style.opacity = '1';
                bar.style.pointerEvents = 'auto';
            }

            barItems.innerHTML = [...selected.entries()].map(([id, m]) => `
            <div class="bar-chip">
                <img src="${m.img}" alt="${m.name}">
                <div class="bar-chip-info">
                    <div class="bar-chip-name">${m.name}</div>
                    <div class="bar-chip-price">${m.price}</div>
                </div>
                <button class="bar-chip-remove" onclick="removeMotor(${id})" aria-label="Hapus ${m.name}">✕</button>
            </div>
        `).join('');

            requestAnimationFrame(syncScrollUI);
        }

        /* ─── SCROLL ARROWS ─── */
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

        /* ─── DRAG TO SCROLL ─── */
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

        /*
         * ─── LIVEWIRE HOOK ───
         * Setelah Livewire re-render (filter/halaman berubah):
         * 1. Scroll ke atas
         * 2. Sync visual kartu yang masih terpilih
         */
        document.addEventListener('livewire:navigated', syncAllCards);

        if (typeof Livewire !== 'undefined') {
            Livewire.hook('commit', ({
                succeed
            }) => {
                succeed(() => {
                    requestAnimationFrame(() => {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        syncAllCards();
                    });
                });
            });
        }

        function syncAllCards() {
            selected.forEach((_, id) => syncCard(id));
        }
    })();
</script>
@endpush