<?php
namespace App\Livewire\Pages\LandingPage;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]class HomePage extends Component
{
    public $currentPage = 'home';

    public function navigate($page)
    {
        $this->currentPage = $page;
    }

    public function render()
    {
        return view('livewire.pages.landing-page.home-page');
    }
}