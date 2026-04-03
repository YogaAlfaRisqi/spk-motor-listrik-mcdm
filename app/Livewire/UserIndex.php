<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    use WithPagination;

    public string $search    = '';
    public string $roleFilter = '';
    public string $sortBy    = 'created_at';
    public string $sortDir   = 'desc';

    // Reset pagination when search/filter changes
    public function updatingSearch(): void    { $this->resetPage(); }
    public function updatingRoleFilter(): void { $this->resetPage(); }

    // ─── Field Schema ─────────────────────────────────────────────────────────

    private function fields(bool $isEdit = false): array
    {
        return [
            [
                'name'        => 'name',
                'label'       => 'Full Name',
                'type'        => 'text',
                'placeholder' => 'e.g. Budi Santoso',
                'required'    => true,
                'rules'       => 'required|string|max:255',
            ],
            [
                'name'        => 'email',
                'label'       => 'Email Address',
                'type'        => 'email',
                'placeholder' => 'budi@example.com',
                'required'    => true,
                'rules'       => 'required|email|max:255',
            ],
            [
                'name'        => 'password',
                'label'       => $isEdit ? 'New Password' : 'Password',
                'type'        => 'password',
                'placeholder' => $isEdit ? 'Leave blank to keep current' : 'Min. 8 characters',
                'required'    => ! $isEdit,
                'rules'       => $isEdit ? 'nullable|min:8' : 'required|min:8',
                'help'        => $isEdit ? 'Leave empty if you don\'t want to change the password.' : '',
            ],
            [
                'name'    => 'role',
                'label'   => 'Role',
                'type'    => 'select',
                'options' => [
                    'admin'   => '👑 Admin',
                    'manager' => '🧑‍💼 Manager',
                    'editor'  => '✏️ Editor',
                    'viewer'  => '👁️ Viewer',
                ],
                'default'  => 'viewer',
                'required' => true,
                'rules'    => 'required|in:admin,manager,editor,viewer',
            ],
            [
                'name'        => 'phone',
                'label'       => 'Phone Number',
                'type'        => 'tel',
                'placeholder' => '+62 812 3456 7890',
                'rules'       => 'nullable|string|max:20',
            ],
            [
                'name'    => 'is_active',
                'label'   => 'Account Status',
                'type'    => 'toggle',
                'placeholder' => 'Active',
                'default' => true,
            ],
        ];
    }

    // ─── Open Modals ──────────────────────────────────────────────────────────

    public function openCreate(): void
    {
        $this->dispatch('modal:open-create',
            title:  'Add New User',
            fields: $this->fields(isEdit: false),
            size:   'lg',
        );
    }

    public function openEdit(int $id): void
    {
        $user = User::findOrFail($id);

        $this->dispatch('modal:open-edit',
            title:  'Edit User — ' . $user->name,
            fields: $this->fields(isEdit: true),
            record: [
                'name'      => $user->name,
                'email'     => $user->email,
                'password'  => '',              // never pre-fill password
                'role'      => $user->role,
                'phone'     => $user->phone ?? '',
                'is_active' => $user->is_active,
            ],
            id:   $id,
            size: 'lg',
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

    // ─── Handle Modal Results ─────────────────────────────────────────────────

    #[On('modal:submitted-create')]
    public function handleCreate(array $data): void
    {
        User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'role'      => $data['role'],
            'phone'     => $data['phone'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ]);

        session()->flash('toast', ['type' => 'success', 'message' => "User \"{$data['name']}\" created successfully."]);
    }

    #[On('modal:submitted-edit')]
    public function handleEdit(int $id, array $data): void
    {
        $user    = User::findOrFail($id);
        $payload = [
            'name'      => $data['name'],
            'email'     => $data['email'],
            'role'      => $data['role'],
            'phone'     => $data['phone'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ];

        // Only update password if a new one was provided
        if (!empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $user->update($payload);

        session()->flash('toast', ['type' => 'success', 'message' => "User \"{$user->name}\" updated successfully."]);
    }

    #[On('modal:submitted-delete')]
    public function handleDelete(int $id): void
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        session()->flash('toast', ['type' => 'warning', 'message' => "User \"{$name}\" has been deleted."]);
    }

    // ─── Sorting ──────────────────────────────────────────────────────────────

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy  = $column;
            $this->sortDir = 'asc';
        }
    }

    // ─── Render ───────────────────────────────────────────────────────────────

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
            )
            ->when($this->roleFilter, fn ($q) =>
                $q->where('role', $this->roleFilter)
            )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(10);

        $stats = [
            'total'   => User::count(),
            'active'  => User::where('is_active', true)->count(),
            'admins'  => User::where('role', 'admin')->count(),
        ];

        return view('livewire.users.index', compact('users', 'stats'))
            ->title('Users Management');
    }
}