<div> 
    <livewire:shared.global-modal />
    <div class="p-6">

        <div class="flex justify-between mb-4">
            <input type="text" wire:model.live="search"
                   placeholder="Search criteria..."
                   class="border rounded px-3 py-2">

            <button wire:click="create"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                + Create
            </button>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Weight</th>
                    <th class="w-40">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($criterias as $c)
                    <tr>
                        <td class="p-2">{{ $c->code }}</td>
                        <td>{{ $c->name }}</td>
                        <td>
                            <span class="px-2 py-1 rounded text-white
                                {{ $c->type === 'benefit' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $c->type }}
                            </span>
                        </td>
                        <td>{{ $c->weight }}</td>
                        <td>
                            <button wire:click="edit({{ $c->id }})">Edit</button>
                            <button wire:click="delete({{ $c->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $criterias->links() }}

    </div>

</div>