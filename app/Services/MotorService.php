<?php

namespace App\Services;

use App\Models\MotorListrik;
use Illuminate\Database\Eloquent\Collection;

class MotorService
{
    /**
     * Ambil semua motor dengan filter dan sorting.
     */
    public function getFiltered(
        string $sort = 'terbaru',
        int $maxHarga = 100,
        array $brands = [],
        int $battery = 0
    ): Collection {
        $query = MotorListrik::query();

        $this->applyBrandFilter($query, $brands);
        $this->applyPriceFilter($query, $maxHarga);
        $this->applyBatteryFilter($query, $battery);
        $this->applySorting($query, $sort);

        return $query->get();
    }

    /**
     * Filter berdasarkan brand (nama motor mengandung nama brand).
     */
    private function applyBrandFilter($query, array $brands): void
    {
        if (empty($brands)) {
            return;
        }

        $query->where(function ($q) use ($brands) {
            foreach ($brands as $brand) {
                $q->orWhere('nama_motor', 'like', '%' . $brand . '%');
            }
        });
    }

    /**
     * Filter berdasarkan harga maksimum (dalam juta rupiah).
     */
    private function applyPriceFilter($query, int $maxHarga): void
    {
        $query->where('harga', '<=', $maxHarga * 1_000_000);
    }

    /**
     * Filter berdasarkan kapasitas baterai.
     * 0 = Semua, 1 = < 2.0, 2 = 2.0–3.0, 3 = > 3.0
     */
    private function applyBatteryFilter($query, int $battery): void
    {
        match ($battery) {
            1 => $query->where('kapasitas_baterai', '<', 2.0),
            2 => $query->whereBetween('kapasitas_baterai', [2.0, 3.0]),
            3 => $query->where('kapasitas_baterai', '>', 3.0),
            default => null,
        };
    }

    /**
     * Terapkan sorting berdasarkan pilihan pengguna.
     */
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