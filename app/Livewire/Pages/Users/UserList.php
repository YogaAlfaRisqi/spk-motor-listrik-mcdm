<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserList extends Component
{
    use WithPagination;

    protected $listeners = [
        'user-created' => '$refresh',
        'user-updated' => '$refresh',
        'user-deleted' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.users.user-list', [
            'users' => User::latest()->paginate(10)
        ]);
    }
}