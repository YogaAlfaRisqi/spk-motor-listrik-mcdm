<?php

namespace App\Livewire;

use App\Services\AlternativeService;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('livewire.layouts.motor')]
class MotorPage extends Component
{
    // public string $currentPage = '/';

    public array $motors = [];

    public function mount(AlternativeService $motorService): void
    {
        $this->motors = $motorService
        ->getCollection()
        ->toArray()
        ;
    }

    public function navigate(string $page): void
    {
        // $this->currentPage = $page;
    }

    public function render()
    {
        return view('livewire.pages.motor.motor-overview', [
            'motors' => $this->motors,
        ]);
    }
}