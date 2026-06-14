<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('livewire.layouts.guest')]
class HomePage extends Component
{
    public string $currentPage = '/';

    public function navigate($page)
    {
        $this->currentPage = $page;
    }
    public function render()
    {
        return view('livewire.pages.landing-page.home-page');
    }
}