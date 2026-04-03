<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * Example parent component that drives the reusable ModalForm.
 * Drop <livewire:user-table /> anywhere in a Blade layout.
 */
class UserTable extends Component
{
    public string $search = '';

    // ─── Field schema ─────────────────────────────────────────────────────────

    private function fields(): array
    {
        return [
            [
                'name'        => 'name',
                'label'       => 'Full Name',
                'type'        => 'text',
                'placeholder' => 'John Doe',
                'required'    => true,
                'rules'       => 'required|string|max:255',
            ],
            [
                'name'        => 'email',
                'label'       => 'Email Address',
                'type'        => 'email',
                'placeholder' => 'john@example.com',
                'required'    => true,
                'rules'       => 'required|email|max:255',
            ],
            [
                'name'    => 'role',
                'label'   => 'Role',
                'type'    => 'select',
                'options' => ['admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer'],
                'default' => 'viewer',
                'rules'   => 'required|in:admin,editor,viewer',
            ],
            [
                'name'    => 'is_active',
                'label'   => 'Status',
                'type'    => 'toggle',
                'placeholder' => 'Active account',
                'default' => true,
            ],
            [
                'name'        => 'bio',
                'label'       => 'Bio',
                'type'        => 'textarea',
                'placeholder' => 'A short description…',
                'rows'        => 2,
                'rules'       => 'nullable|string|max:500',
                'help'        => 'Max 500 characters.',
            ],
        ];
    }

    // ─── Open helpers ─────────────────────────────────────────────────────────

    public function openCreate(): void
    {
        $this->dispatch('modal:open-create',
            title:  'Add New User',
            fields: $this->fields(),
            size:   'lg',
        );
    }

    public function openEdit(int $id): void
    {
        $user = User::findOrFail($id);

        $this->dispatch('modal:open-edit',
            title:  'Edit User',
            fields: $this->fields(),
            record: $user->toArray(),
            id:     $id,
            size:   'lg',
        );
    }

    public function openDelete(int $id): void
    {
        $user = User::findOrFail($id);

        $this->dispatch('modal:open-delete',
            title: 'Delete User',
            id:    $id,
            label: $user->name,
        );
    }

    // ─── Modal response handlers ──────────────────────────────────────────────

    #[On('modal:submitted-create')]
    public function handleCreate(array $data): void
    {
        User::create($data);
        session()->flash('success', 'User created successfully.');
    }

    #[On('modal:submitted-edit')]
    public function handleEdit(int $id, array $data): void
    {
        User::findOrFail($id)->update($data);
        session()->flash('success', 'User updated successfully.');
    }

    #[On('modal:submitted-delete')]
    public function handleDelete(int $id): void
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'User deleted successfully.');
    }

    // ─── Render ───────────────────────────────────────────────────────────────

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(10);

        return view('livewire.user-table', compact('users'));
    }
}