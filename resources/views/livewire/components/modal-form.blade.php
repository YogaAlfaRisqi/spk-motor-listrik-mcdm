{{-- ============================================================
     resources/views/livewire/components/modal-form.blade.php
     Reusable CRUD Modal — Livewire 4
     ============================================================ --}}

@php
    $sizeClass = match($size) {
        'sm'   => 'max-w-sm',
        'lg'   => 'max-w-2xl',
        'xl'   => 'max-w-4xl',
        'full' => 'max-w-full mx-4',
        default => 'max-w-lg',
    };
@endphp

{{-- Backdrop --}}
<div
    x-data
    x-cloak
    x-show="$wire.open"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="$wire.close()"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    role="dialog"
    aria-modal="true"
>
    {{-- Overlay --}}
    <div
        class="absolute inset-0 bg-gray-950/60 backdrop-blur-sm"
        @click="$wire.close()"
        aria-hidden="true"
    ></div>

    {{-- Panel --}}
    <div
        x-show="$wire.open"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        class="relative w-full {{ $sizeClass }} bg-white dark:bg-gray-900 rounded-2xl shadow-2xl ring-1 ring-black/5 dark:ring-white/10 overflow-hidden"
    >
        {{-- ── Header ──────────────────────────────────────────── --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3">
                {{-- Mode icon --}}
                @if($mode === 'delete')
                    <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </span>
                @elseif($mode === 'edit')
                    <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </span>
                @else
                    <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                @endif

                <h2 class="text-base font-semibold text-gray-900 dark:text-white tracking-tight">
                    {{ $title }}
                </h2>
            </div>

            <button
                wire:click="close"
                type="button"
                class="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500"
                aria-label="Close modal"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- ── Body ─────────────────────────────────────────────── --}}
        <div class="px-6 py-5">

            {{-- DELETE confirmation --}}
            @if($mode === 'delete')
                <div class="text-center py-2">
                    <div class="mx-auto mb-4 flex items-center justify-center w-14 h-14 rounded-full bg-red-50 dark:bg-red-900/20">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        Are you sure you want to delete
                        @if(!empty($formData['_label']))
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $formData['_label'] }}</span>?
                        @else
                            this record?
                        @endif
                    </p>
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">This action cannot be undone.</p>
                </div>

            {{-- CREATE / EDIT form --}}
            @else
                <div class="space-y-4">
                    @foreach($fields as $field)
                        @php
                            $fieldName  = $field['name'];
                            $fieldLabel = $field['label'] ?? ucfirst(str_replace('_', ' ', $fieldName));
                            $fieldType  = $field['type'] ?? 'text';
                            $required   = !empty($field['required']);
                            $placeholder= $field['placeholder'] ?? '';
                            $help       = $field['help'] ?? '';
                        @endphp

                        <div>
                            <label
                                for="field_{{ $fieldName }}"
                                class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5 tracking-wide uppercase"
                            >
                                {{ $fieldLabel }}
                                @if($required)
                                    <span class="text-red-400 ml-0.5">*</span>
                                @endif
                            </label>

                            {{-- Text / Email / Number / Password / URL / Tel --}}
                            @if(in_array($fieldType, ['text','email','number','password','url','tel','date','time','datetime-local','color']))
                                <input
                                    id="field_{{ $fieldName }}"
                                    type="{{ $fieldType }}"
                                    wire:model="formData.{{ $fieldName }}"
                                    placeholder="{{ $placeholder }}"
                                    @if($required) required @endif
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border
                                        border-gray-200 dark:border-gray-700
                                        bg-white dark:bg-gray-800
                                        text-gray-900 dark:text-gray-100
                                        placeholder-gray-400 dark:placeholder-gray-500
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-400
                                        transition
                                        @error('formData.'.$fieldName) border-red-400 focus:ring-red-400/40 @enderror"
                                />

                            {{-- Textarea --}}
                            @elseif($fieldType === 'textarea')
                                <textarea
                                    id="field_{{ $fieldName }}"
                                    wire:model="formData.{{ $fieldName }}"
                                    placeholder="{{ $placeholder }}"
                                    rows="{{ $field['rows'] ?? 3 }}"
                                    @if($required) required @endif
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border resize-y
                                        border-gray-200 dark:border-gray-700
                                        bg-white dark:bg-gray-800
                                        text-gray-900 dark:text-gray-100
                                        placeholder-gray-400 dark:placeholder-gray-500
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-400
                                        transition
                                        @error('formData.'.$fieldName) border-red-400 focus:ring-red-400/40 @enderror"
                                ></textarea>

                            {{-- Select --}}
                            @elseif($fieldType === 'select')
                                <select
                                    id="field_{{ $fieldName }}"
                                    wire:model="formData.{{ $fieldName }}"
                                    @if($required) required @endif
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border
                                        border-gray-200 dark:border-gray-700
                                        bg-white dark:bg-gray-800
                                        text-gray-900 dark:text-gray-100
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-400
                                        transition
                                        @error('formData.'.$fieldName) border-red-400 focus:ring-red-400/40 @enderror"
                                >
                                    @if(!empty($placeholder))
                                        <option value="">{{ $placeholder }}</option>
                                    @endif
                                    @foreach(($field['options'] ?? []) as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                    @endforeach
                                </select>

                            {{-- Checkbox --}}
                            @elseif($fieldType === 'checkbox')
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input
                                        id="field_{{ $fieldName }}"
                                        type="checkbox"
                                        wire:model="formData.{{ $fieldName }}"
                                        class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-500
                                               focus:ring-indigo-500/40 bg-white dark:bg-gray-800 transition"
                                    />
                                    <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition">
                                        {{ $placeholder ?: $fieldLabel }}
                                    </span>
                                </label>

                            {{-- Radio group --}}
                            @elseif($fieldType === 'radio')
                                <div class="flex flex-wrap gap-3">
                                    @foreach(($field['options'] ?? []) as $val => $label)
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input
                                                type="radio"
                                                wire:model="formData.{{ $fieldName }}"
                                                value="{{ $val }}"
                                                class="w-4 h-4 border-gray-300 dark:border-gray-600 text-indigo-500
                                                       focus:ring-indigo-500/40 bg-white dark:bg-gray-800"
                                            />
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            {{-- Toggle / Switch --}}
                            @elseif($fieldType === 'toggle')
                                <div x-data class="flex items-center gap-3">
                                    <button
                                        type="button"
                                        @click="$wire.set('formData.{{ $fieldName }}', !$wire.formData['{{ $fieldName }}'])"
                                        :class="$wire.formData['{{ $fieldName }}'] ? 'bg-indigo-500' : 'bg-gray-200 dark:bg-gray-700'"
                                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                    >
                                        <span
                                            :class="$wire.formData['{{ $fieldName }}'] ? 'translate-x-6' : 'translate-x-1'"
                                            class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform"
                                        ></span>
                                    </button>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $placeholder ?: $fieldLabel }}
                                    </span>
                                </div>

                            @endif

                            {{-- Validation error --}}
                            @error('formData.'.$fieldName)
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            {{-- Help text --}}
                            @if($help && !$errors->has('formData.'.$fieldName))
                                <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">{{ $help }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ── Footer ───────────────────────────────────────────── --}}
        <div class="flex items-center justify-end gap-2.5 px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-800">

            <button
                type="button"
                wire:click="close"
                class="px-4 py-2 text-sm font-medium rounded-xl
                    text-gray-600 dark:text-gray-300
                    bg-white dark:bg-gray-800
                    border border-gray-200 dark:border-gray-700
                    hover:bg-gray-50 dark:hover:bg-gray-700
                    focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600
                    transition-all"
            >
                Cancel
            </button>

            @if($mode === 'delete')
                <button
                    type="button"
                    wire:click="confirmDelete"
                    wire:loading.attr="disabled"
                    wire:target="confirmDelete"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-xl
                        text-white bg-red-500 hover:bg-red-600
                        focus:outline-none focus:ring-2 focus:ring-red-400/50
                        disabled:opacity-60 disabled:cursor-not-allowed
                        transition-all shadow-sm shadow-red-500/20"
                >
                    <span wire:loading.remove wire:target="confirmDelete">Delete</span>
                    <span wire:loading wire:target="confirmDelete" class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"/>
                        </svg>
                        Deleting…
                    </span>
                </button>

            @else
                <button
                    type="button"
                    wire:click="submit"
                    wire:loading.attr="disabled"
                    wire:target="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-xl
                        text-white bg-indigo-500 hover:bg-indigo-600
                        focus:outline-none focus:ring-2 focus:ring-indigo-400/50
                        disabled:opacity-60 disabled:cursor-not-allowed
                        transition-all shadow-sm shadow-indigo-500/25"
                >
                    <span wire:loading.remove wire:target="submit">
                        {{ $mode === 'edit' ? 'Save Changes' : 'Create' }}
                    </span>
                    <span wire:loading wire:target="submit" class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"/>
                        </svg>
                        Saving…
                    </span>
                </button>
            @endif
        </div>
    </div>
</div>