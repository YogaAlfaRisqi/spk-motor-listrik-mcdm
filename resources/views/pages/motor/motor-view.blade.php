<x-layouts.app>
    <div class="pt-[120px] min-h-screen bg-[#0A0C0F] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- SIDEBAR -->
                <aside class="lg:col-span-3">
                    <div class="sticky top-[120px] max-h-[calc(100vh-140px)] overflow-y-auto bg-[#14161A] border border-white/5 p-6 rounded-2xl">
                        
                        <h2 class="font-syne font-extrabold text-xl mb-6 text-[#C8F135] tracking-tight">
                            Filter Pencarian
                        </h2>

                        <div class="space-y-8">

                            <!-- Sorting -->
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">
                                    Urutkan
                                </label>
                                <select class="w-full bg-[#0A0C0F] border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-[#C8F135] outline-none">
                                    <option>Terbaru</option>
                                    <option>Harga Terendah</option>
                                    <option>Harga Tertinggi</option>
                                </select>
                            </div>

                            <!-- Range -->
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">
                                    Rentang Harga (Juta)
                                </label>
                                <input type="range" min="10" max="100" 
                                    class="w-full accent-[#C8F135] cursor-pointer">
                                <div class="flex justify-between text-[10px] mt-3 text-gray-500 font-bold">
                                    <span>10jt</span>
                                    <span>100jt</span>
                                </div>
                            </div>

                            <!-- Brand -->
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">
                                    Brand
                                </label>

                                <div class="space-y-3">
                                    @foreach(['Gesits', 'Alva', 'Uwinfly', 'Polytron'] as $brand)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox"
                                            class="w-5 h-5 rounded border border-white/10 bg-[#0A0C0F] 
                                            checked:bg-[#C8F135] checked:border-[#C8F135] 
                                            appearance-none flex items-center justify-center">

                                        <span class="text-sm text-gray-400 group-hover:text-white transition">
                                            {{ $brand }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <button class="w-full py-4 bg-[#C8F135] text-black font-black text-xs uppercase tracking-tight rounded-xl hover:scale-[1.02] active:scale-95 transition">
                                Terapkan Filter
                            </button>

                        </div>
                    </div>
                </aside>

                <!-- CONTENT -->
                <main class="lg:col-span-9">

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">

                        @for ($i = 1; $i <= 6; $i++)
                        <div class="flex flex-col bg-[#14161A] border border-white/5 rounded-2xl overflow-hidden group hover:border-[#C8F135]/30 transition">

                            <!-- Image -->
                            <div class="aspect-square bg-[#1a1d23] overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1620336655174-32ec75d04d2e?q=80&w=500"
                                    class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition duration-700">
                            </div>

                            <!-- Info -->
                            <div class="p-6 flex flex-col flex-1">

                                <h3 class="font-syne font-bold text-xl mb-1 group-hover:text-[#C8F135] transition">
                                    Alva One Velocity
                                </h3>

                                <p class="text-[#C8F135] font-black text-lg mb-6 font-syne">
                                    Rp 29.490.000
                                </p>

                                <div class="grid grid-cols-2 gap-2 mb-6">
                                    <div class="bg-[#0A0C0F] p-3 rounded-xl border border-white/5">
                                        <p class="text-[8px] text-gray-500 uppercase font-bold mb-1">Jarak</p>
                                        <p class="text-xs font-bold">70 Km</p>
                                    </div>
                                    <div class="bg-[#0A0C0F] p-3 rounded-xl border border-white/5">
                                        <p class="text-[8px] text-gray-500 uppercase font-bold mb-1">Top Speed</p>
                                        <p class="text-xs font-bold">90 Km/h</p>
                                    </div>
                                </div>

                                <!-- BUTTON FIX -->
                                <div class="mt-auto">
                                    <button onclick="selectMotor({{ $i }})"
                                        class="w-full py-3 border border-[#C8F135]/50 text-[#C8F135] rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-[#C8F135] hover:text-black transition flex items-center justify-center gap-2">
                                        <span class="text-lg">+</span> Bandingkan
                                    </button>
                                </div>

                            </div>
                        </div>
                        @endfor

                    </div>
                </main>

            </div>
        </div>
    </div>

    <!-- FLOATING BAR -->
    <div id="spkBar"
        class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[92%] max-w-xl translate-y-40 transition-all duration-500 z-50">

        <div class="bg-[#14161A]/80 backdrop-blur-xl border border-[#C8F135]/30 p-4 rounded-full flex justify-between items-center px-6">

            <div class="text-xs font-bold">
                <span id="countMotor">0</span> Motor dipilih
            </div>

            <div class="flex gap-3">
                <button onclick="clearSelection()" class="text-gray-400 text-xs">Hapus</button>
                <button class="bg-[#C8F135] text-black px-4 py-2 rounded-full text-xs font-bold">
                    Proses
                </button>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        let selected = [];

        function selectMotor(id) {
            if (!selected.includes(id)) {
                selected.push(id);
                updateBar();
            }
        }

        function clearSelection() {
            selected = [];
            updateBar();
        }

        function updateBar() {
            const bar = document.getElementById('spkBar');
            const count = document.getElementById('countMotor');

            count.innerText = selected.length;

            bar.classList.toggle('translate-y-40', selected.length === 0);
            bar.classList.toggle('translate-y-0', selected.length > 0);
        }
    </script>
    @endpush

</x-layouts.app>