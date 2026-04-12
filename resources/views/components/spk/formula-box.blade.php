@props([
    'title' => 'Formula',
    'formula' => '',
    'desc' => '',
    'color' => 'blue' // blue | green | purple | orange
])

@php
    $colors = [
        'blue' => 'bg-blue-50 border-blue-200 dark:bg-blue-900/20 dark:border-blue-800',
        'green' => 'bg-green-50 border-green-200 dark:bg-green-900/20 dark:border-green-800',
        'purple' => 'bg-purple-50 border-purple-200 dark:bg-purple-900/20 dark:border-purple-800',
        'orange' => 'bg-orange-50 border-orange-200 dark:bg-orange-900/20 dark:border-orange-800',
    ];

    $textColors = [
        'blue' => 'text-blue-700 dark:text-blue-300',
        'green' => 'text-green-700 dark:text-green-300',
        'purple' => 'text-purple-700 dark:text-purple-300',
        'orange' => 'text-orange-700 dark:text-orange-300',
    ];
@endphp

<div class="p-4 rounded-xl border {{ $colors[$color] ?? $colors['blue'] }}">

    {{-- TITLE --}}
    <h5 class="font-semibold mb-2 text-gray-800 dark:text-white">
        {{ $title }}
    </h5>

    {{-- FORMULA --}}
    <div class="text-sm font-mono {{ $textColors[$color] ?? $textColors['blue'] }}">
        {!! $formula !!}
    </div>

    {{-- DESCRIPTION --}}
    @if($desc)
        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
            {{ $desc }}
        </p>
    @endif

</div>