<?php

namespace App\Livewire\Pages\MotorPage;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.motor-layout')] // Gunakan layout app, bukan admin
class Motor extends Component
{
    public $selected = [];

    public function mount(): void
    {
        // Explicitly initialize as empty array
        $this->selected = [];
    }

    public function hydrate(): void
    {
        // Ensure selected is always an array after hydration
        if (!is_array($this->selected)) {
            $this->selected = [];
        }
    }

    #[Computed]
public function motors(): array
{
    return [
        [
            'id' => 1,
            'name' => 'Polytron Fox-350 - Battery As A Service - Motor Listrik - ON THE ROAD JADETABEK, BANTEN',
            'short_name' => 'Fox 350',
            'model' => 'Fox 350',
            'brand' => 'Polytron',
            'price' => 'Rp16.000.000',
            'original_price' => 'Rp22.500.000',
            'discount' => 'Rp6.500.000',
            'range' => '130 KM',
            'top_speed' => '95 Km/h',
            'motor_power' => '3000 Watt',
            'battery' => '3.75 kWh',
            'region' => 'KHUSUS JADETABEK, BANTEN',
            'image' => 'https://via.placeholder.com/300x200',
        ],
        [
            'id' => 2,
            'name' => 'Polytron Fox-350 - Battery As A Service - Motor Listrik - OTR JAWA TENGAH & YOGYAKARTA',
            'short_name' => 'Fox 350',
            'model' => 'Fox 350',
            'brand' => 'Polytron',
            'price' => 'Rp15.800.000',
            'original_price' => 'Rp22.300.000',
            'discount' => 'Rp6.500.000',
            'range' => '130 KM',
            'top_speed' => '95 Km/h',
            'motor_power' => '3000 Watt',
            'battery' => '3.75 kWh',
            'region' => 'KHUSUS JAWA TENGAH & YOGYAKARTA',
            'image' => 'https://via.placeholder.com/300x200',
        ],
        [
            'id' => 3,
            'name' => 'Polytron Fox-200 Electric Sededa Motor Listrik - OTR JADETABEK',
            'short_name' => 'Fox 200',
            'model' => 'Fox 200',
            'brand' => 'Polytron',
            'price' => 'Rp11.500.000',
            'original_price' => 'Rp18.500.000',
            'discount' => 'Rp7.000.000',
            'range' => '85 KM',
            'top_speed' => '70 Km/h',
            'motor_power' => '1500 Watt',
            'battery' => '1.94 kWh',
            'region' => 'KHUSUS JADETABEK, BANTEN',
            'image' => 'https://via.placeholder.com/300x200',
        ],
    ];
}

    #[Computed]
    public function isValid(): bool
    {
        return is_array($this->selected) && count($this->selected) >= 3;
    }

    #[Computed]
    public function selectedCount(): int
    {
        return is_array($this->selected) ? count($this->selected) : 0;
    }

    public function toggleMotor(int $id): void
    {
        // Ensure selected is always an array
        if (!is_array($this->selected)) {
            $this->selected = [];
        }

        if (in_array($id, $this->selected)) {
            // remove
            $this->selected = array_values(array_diff($this->selected, [$id]));
        } else {
            // limit max 4
            if (count($this->selected) >= 4) {
                return;
            }

            $this->selected[] = $id;
        }
    }

    public function isMotorSelected(int $id): bool
    {
        return is_array($this->selected) && in_array($id, $this->selected);
    }

    public function render()
    {
        return view('livewire.pages.motor-page');
    }
}
