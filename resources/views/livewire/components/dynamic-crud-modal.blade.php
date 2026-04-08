<div>
@if(isset($show) && $show)
<div class="fixed inset-0 z-50 flex items-center justify-center">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50" wire:click="close"></div>

    <!-- Modal -->
    <div class="relative bg-white w-full max-w-xl rounded-2xl shadow-xl p-6"
         wire:key="{{ $mode }}-{{ $modelId }}">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">{{ $title }}</h2>
            <button wire:click="close">✕</button>
        </div>

        <!-- Body -->
        <div class="space-y-4">

            @if($mode === 'delete')
                <p class="text-gray-600">
                    Yakin ingin menghapus data ini?
                </p>
            @else

                @foreach($fields as $field)
                    <div>
                        <label class="text-sm font-medium">
                            {{ $field['label'] }}
                        </label>

                        @if(($field['type'] ?? 'text') === 'select')
                            <select wire:model.defer="data.{{ $field['name'] }}"
                                    class="w-full border rounded-lg p-2">
                                @foreach($field['options'] as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>

                        @elseif(($field['type'] ?? '') === 'textarea')
                            <textarea wire:model.defer="data.{{ $field['name'] }}"
                                      class="w-full border rounded-lg p-2"></textarea>

                        @else
                            <input type="{{ $field['type'] ?? 'text' }}"
                                   wire:model.defer="data.{{ $field['name'] }}"
                                   class="w-full border rounded-lg p-2"
                                   {{ $mode === 'view' ? 'disabled' : '' }}>
                        @endif

                        @error('data.' . $field['name'])
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                @endforeach

            @endif
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-2 mt-6">

            <button wire:click="close" class="px-4 py-2 border rounded-lg">
                Batal
            </button>

            @if($mode === 'delete')
                <button wire:click="delete"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    Hapus
                </button>

            @elseif($mode !== 'view')
                <button wire:click="save"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan
                </button>
            @endif

        </div>

    </div>
</div>
@endif
</div>