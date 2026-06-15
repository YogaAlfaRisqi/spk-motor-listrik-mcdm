@if ($paginator->hasPages())
<nav
    role="navigation"
    aria-label="Navigasi halaman"
    class="flex items-center justify-between gap-4 mt-10 flex-wrap"
>
    {{-- Info: "Menampilkan X–Y dari Z motor" --}}
    <p class="text-[11px] font-semibold text-white/30 tabular-nums">
        Menampilkan
        <span class="text-white/60">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
        dari
        <span class="text-white/60">{{ $paginator->total() }}</span>
        motor
    </p>

    {{-- Tombol navigasi --}}
    <div class="flex items-center gap-1.5 flex-wrap">

        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span class="pg-btn" aria-disabled="true">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="opacity-30">
                    <path d="M8.5 10.5L5 7l3.5-3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        @else
            <button
                wire:click="previousPage"
                wire:loading.attr="disabled"
                class="pg-btn hover:border-[#C8F135]/50 hover:text-[#C8F135]"
                aria-label="Halaman sebelumnya"
            >
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M8.5 10.5L5 7l3.5-3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        @endif

        {{-- Nomor halaman + ellipsis --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pg-dots">···</span>
            @elseif (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page === $paginator->currentPage())
                        <span class="pg-btn pg-active" aria-current="page">{{ $page }}</span>
                    @else
                        <button
                            wire:click="gotoPage({{ $page }})"
                            wire:loading.attr="disabled"
                            class="pg-btn hover:border-[#C8F135]/50 hover:text-[#C8F135]"
                            aria-label="Halaman {{ $page }}"
                        >{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button
                wire:click="nextPage"
                wire:loading.attr="disabled"
                class="pg-btn hover:border-[#C8F135]/50 hover:text-[#C8F135]"
                aria-label="Halaman berikutnya"
            >
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M5.5 3.5L9 7l-3.5 3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        @else
            <span class="pg-btn" aria-disabled="true">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="opacity-30">
                    <path d="M5.5 3.5L9 7l-3.5 3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        @endif

    </div>
</nav>

<style>
    .pg-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 8px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid rgba(255, 255, 255, .08);
        background: #14161A;
        color: rgba(255, 255, 255, .4);
        cursor: pointer;
        transition: border-color .15s, color .15s, background .15s;
        user-select: none;
    }
    .pg-btn[aria-disabled="true"] {
        cursor: default;
        pointer-events: none;
    }
    .pg-active {
        background: #C8F135 !important;
        color: #000 !important;
        border-color: #C8F135 !important;
        cursor: default;
        pointer-events: none;
    }
    .pg-dots {
        color: rgba(255, 255, 255, .2);
        font-size: 12px;
        padding: 0 2px;
        line-height: 34px;
    }
</style>
@endif