<form wire:submit.prevent="save" class="space-y-4">

    <div>
        <label>Code</label>
        <input type="text" wire:model="form.code"
               class="w-full border px-3 py-2 rounded">
        @error('form.code') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Name</label>
        <input type="text" wire:model="form.name"
               class="w-full border px-3 py-2 rounded">
        @error('form.name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Type</label>
        <select wire:model="form.type"
                class="w-full border px-3 py-2 rounded">
            <option value="">-- Select --</option>
            <option value="benefit">Benefit</option>
            <option value="cost">Cost</option>
        </select>
        @error('form.type') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Weight</label>
        <input type="number" step="0.01" wire:model="form.weight"
               class="w-full border px-3 py-2 rounded">
        @error('form.weight') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end">
        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </div>

</form>