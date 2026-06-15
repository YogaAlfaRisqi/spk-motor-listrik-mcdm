<?php

namespace App\Livewire;

use App\Services\MotorService;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('livewire.layouts.motor')]
class MotorPage extends Component
{
    public string $sort     = 'terbaru';
    public int    $maxHarga = 100;
    public array  $brands   = [];
    public int    $battery  = 0;

    public function resetFilter(): void
    {
        $this->sort     = 'terbaru';
        $this->maxHarga = 100;
        $this->brands   = [];
        $this->battery  = 0;
    }

    public function render(MotorService $motorService)
    {
        return view('livewire.pages.motor.motor-overview', [
            'motors' => $motorService->getFiltered(
                sort:     $this->sort,
                maxHarga: $this->maxHarga,
                brands:   $this->brands,
                battery:  $this->battery,
            ),
        ]);
    }
}