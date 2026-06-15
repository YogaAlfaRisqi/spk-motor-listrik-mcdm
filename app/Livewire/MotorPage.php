<?php

namespace App\Livewire;

use App\Services\MotorService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('livewire.layouts.motor')]
class MotorPage extends Component
{
    use WithPagination;

    public string $sort     = 'terbaru';
    public int    $maxHarga = 100;
    public array  $brands   = [];
    public int    $battery  = 0;

    /**
     * Reset ke halaman 1 setiap kali filter berubah,
     * agar tidak stuck di halaman yang tidak ada.
     */
    public function updatedSort(): void     { $this->resetPage(); }
    public function updatedMaxHarga(): void { $this->resetPage(); }
    public function updatedBrands(): void   { $this->resetPage(); }
    public function updatedBattery(): void  { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->sort     = 'terbaru';
        $this->maxHarga = 100;
        $this->brands   = [];
        $this->battery  = 0;
        $this->resetPage();
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