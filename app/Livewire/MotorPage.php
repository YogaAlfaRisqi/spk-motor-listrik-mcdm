<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('livewire.layouts.motor')]
class MotorPage extends Component
{
    // public string $currentPage = '/';

    public array $motors = [];

    public function mount(): void
    {
        $this->motors = [
            [
                'id'    => 1,
                'name'  => 'Alva One Velocity',
                'price' => 'Rp 29.490.000',
                'range' => '70 Km',
                'speed' => '90 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1620336655174-32ec75d04d2e?q=80&w=500',
            ],
            [
                'id'    => 2,
                'name'  => 'Gesits G1 Pro',
                'price' => 'Rp 28.750.000',
                'range' => '80 Km',
                'speed' => '85 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1558981285-6f0c94958bb6?q=80&w=500',
            ],
            [
                'id'    => 3,
                'name'  => 'Volta Icon 50',
                'price' => 'Rp 24.900.000',
                'range' => '60 Km',
                'speed' => '80 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=500',
            ],
            [
                'id'    => 4,
                'name'  => 'United T1800',
                'price' => 'Rp 22.500.000',
                'range' => '65 Km',
                'speed' => '75 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1609152132736-fe04e48b1c3a?q=80&w=500',
            ],
            [
                'id'    => 5,
                'name'  => 'Smoot Zuzu',
                'price' => 'Rp 19.800.000',
                'range' => '55 Km',
                'speed' => '70 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=500',
            ],
            [
                'id'    => 6,
                'name'  => 'Viar Q1',
                'price' => 'Rp 17.500.000',
                'range' => '50 Km',
                'speed' => '65 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1574016523481-2c264049e7d0?q=80&w=500',
            ],
            [
                'id'    => 7,
                'name'  => 'Selis E-Max',
                'price' => 'Rp 15.200.000',
                'range' => '45 Km',
                'speed' => '60 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?q=80&w=500',
            ],
            [
                'id'    => 8,
                'name'  => 'Polytron Fox R',
                'price' => 'Rp 13.500.000',
                'range' => '40 Km',
                'speed' => '55 Km/h',
                'img'   => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=500',
            ],
        ];
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