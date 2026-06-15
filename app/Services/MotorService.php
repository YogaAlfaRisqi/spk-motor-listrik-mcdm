<?php

namespace App\Services;

use App\Models\MotorListrik;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MotorService
{
    public const PER_PAGE = 12;

    /**
     * Ambil motor dengan filter, sorting, dan pagination.
     */
    public function getFiltered(
        string $sort     = 'terbaru',
        int    $maxHarga = 100,
        array  $brands   = [],
        int    $battery  = 0,
        int    $perPage  = self::PER_PAGE,
    ): LengthAwarePaginator {
        $query = MotorListrik::query();

        $this->applyBrandFilter($query, $brands);
        $this->applyPriceFilter($query, $maxHarga);
        $this->applyBatteryFilter($query, $battery);
        $this->applySorting($query, $sort);

        return $query->paginate($perPage);
    }

    private function applyBrandFilter($query, array $brands): void
    {
        if (empty($brands)) return;

        $query->where(function ($q) use ($brands) {
            foreach ($brands as $brand) {
                $q->orWhere('nama_motor', 'like', '%' . $brand . '%');
            }
        });
    }

    private function applyPriceFilter($query, int $maxHarga): void
    {
        $query->where('harga', '<=', $maxHarga * 1_000_000);
    }

    private function applyBatteryFilter($query, int $battery): void
    {
        match ($battery) {
            1 => $query->where('kapasitas_baterai', '<', 2.0),
            2 => $query->whereBetween('kapasitas_baterai', [2.0, 3.0]),
            3 => $query->where('kapasitas_baterai', '>', 3.0),
            default => null,
        };
    }

    private function applySorting($query, string $sort): void
    {
        match ($sort) {
            'harga_asc'  => $query->orderBy('harga', 'asc'),
            'harga_desc' => $query->orderBy('harga', 'desc'),
            'jarak_desc' => $query->orderBy('jarak_tempuh', 'desc'),
            'daya_desc'  => $query->orderBy('daya_maksimum', 'desc'),
            default      => $query->orderBy('id_motor', 'asc'),
        };
    }
}