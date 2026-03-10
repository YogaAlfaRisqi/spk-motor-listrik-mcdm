<?php

namespace App\Services;

class AlternativeService
{
    private static array $alternatives = [
        ['id' => 1, 'kode alternatif' => 'A1', '' => 'Alternative 1', 'keterangan' => 'Deskripsi alternatif 1'],
        ['id' => 2, 'kode alternatif' => 'A2', 'name alternatif' => 'Alternative 2', 'keterangan' => 'Deskripsi alternatif 2'],
        ['id' => 3, 'kode alternatif' => 'A3', 'name alternatif' => 'Alternative 3', 'keterangan' => 'Deskripsi alternatif 3'],
    ];

    public static function getAllAlternatives()
    {
        return self::$alternatives;
    }
    public function getAlternativeById($id)
    {
        return collect(self::$alternatives)->firstWhere('id', $id);
    }
}