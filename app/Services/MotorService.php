<?php

namespace App\Services;

use App\Models\MotorListrik;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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

    /**
     * Ambil semua brand unik beserta jumlah motornya.
     * Brand = kata pertama dari nama_motor.
     *
     * @return Collection<int, array{brand: string, count: int}>
     */
    public function getBrandsWithCount(): Collection
    {
        return MotorListrik::query()
            ->selectRaw("TRIM(SUBSTRING_INDEX(nama_motor, ' ', 1)) AS brand, COUNT(*) AS count")
            ->groupByRaw("TRIM(SUBSTRING_INDEX(nama_motor, ' ', 1))")
            ->orderBy('brand')
            ->get()
            ->map(fn ($row) => [
                'brand' => $row->brand,
                'count' => (int) $row->count,
            ]);
    }

    private function applyBrandFilter($query, array $brands): void
    {
        if (empty($brands)) return;

        $query->where(function ($q) use ($brands) {
            foreach ($brands as $brand) {
                // Cocokkan kata pertama saja agar "Gesits" tidak match "Gesitson" dll.
                $q->orWhere('nama_motor', 'like', $brand . ' %')
                  ->orWhere('nama_motor', '=', $brand);
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