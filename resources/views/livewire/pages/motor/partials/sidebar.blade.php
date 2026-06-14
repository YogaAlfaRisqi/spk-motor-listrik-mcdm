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