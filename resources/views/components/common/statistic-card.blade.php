@props(['card'])

<div 
  class="group p-6 rounded-2xl border border-gray-200/70 dark:border-gray-800 
  bg-white dark:bg-gray-900 shadow-sm hover:shadow-md transition-all duration-200">

  <div class="flex items-center justify-between">

    {{-- TEXT --}}
    <div>
      <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $card['label'] ?? '-' }}
      </p>

      <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
        {{ $card['value'] ?? 0 }}
      </h3>

      {{-- OPTIONAL: TREND / SUBTEXT --}}
      @isset($card['trend'])
        <p class="text-xs mt-1 text-green-500 flex items-center gap-1">
          <i data-lucide="trending-up" class="w-3 h-3"></i>
          {{ $card['trend'] }}
        </p>
      @endisset
    </div>

    {{-- ICON --}}
    <div 
      class="p-3 rounded-xl 
      bg-{{ $card['color'] ?? 'gray' }}-100 
      dark:bg-{{ $card['color'] ?? 'gray' }}-900/30
      group-hover:scale-110 transition">

      <i 
        data-lucide="{{ $card['icon'] ?? 'box' }}"
        class="w-6 h-6 text-{{ $card['color'] ?? 'gray' }}-600 
        dark:text-{{ $card['color'] ?? 'gray' }}-400">
      </i>

    </div>

  </div>

</div>