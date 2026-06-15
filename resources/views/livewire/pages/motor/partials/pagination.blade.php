@if ($paginator->hasPages())
<div class="flex items-center justify-center gap-2 flex-wrap">

    {{-- Prev --}}
    @if ($paginator->onFirstPage())
        <button disabled class="pg-btn opacity-30 cursor-default">‹</button>
    @else
        <button wire:click="previousPage" wire:loading.attr="disabled" class="pg-btn">‹</button>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="pg-dots">···</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="pg-btn active">{{ $page }}</button>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="pg-btn">{{ $page }}</button>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <button wire:click="nextPage" wire:loading.attr="disabled" class="pg-btn">›</button>
    @else
        <button disabled class="pg-btn opacity-30 cursor-default">›</button>
    @endif

</div>
@endif