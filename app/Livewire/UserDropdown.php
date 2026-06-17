<?php
namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class UserDropdown extends Component
{
    public function logout(Logout $logout)
    {
        $logout();

        return redirect('/');
    }

    public function render()
    {
        return view('header.user-dropdown');
    }
}