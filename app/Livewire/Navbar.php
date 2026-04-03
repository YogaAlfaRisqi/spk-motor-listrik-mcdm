<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public string $currentPage = 'home';
    public bool $mobileOpen = false;

    protected $listeners = ['navigateTo' => 'navigate'];

    public function mount(): void
    {
        $this->currentPage = request()->routeIs('home') ? 'home' :
            (request()->routeIs('about') ? 'about' :
            (request()->routeIs('recommendation') ? 'recommendation' :
            (request()->routeIs('how-it-works') ? 'how-it-works' : 'home')));
    }

    public function navigate(string $page): void
    {
        $this->currentPage = $page;
        $this->mobileOpen = false;
    }

    public function toggleMobile(): void
    {
        $this->mobileOpen = !$this->mobileOpen;
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}