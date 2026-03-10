<?php

namespace App\Services;

class CriteriaService
{
    private static array $criteria = [
        ['id' => 1, 'kode kriteria' => 'C1', 'name kriteria' => 'Criteria 1', 'keterangan' => 'Biaya awal pembelian', 'tipe' => 'cost'],
        ['id' => 2, 'kode kriteria' => 'C2', 'name kriteria' => 'Criteria 2', 'keterangan' => 'Keuntungan jangka pendek', 'tipe' => 'benefit'],
        ['id' => 3, 'kode kriteria' => 'C3', 'name kriteria' => 'Criteria 3', 'keterangan' => 'Risiko investasi', 'tipe' => 'cost'],
        ['id' => 4, 'kode kriteria' => 'C3', 'name kriteria' => 'Criteria 3', 'keterangan' => 'Risiko investasi', 'tipe' => 'benefit'],
        ['id' => 5, 'kode kriteria' => 'C3', 'name kriteria' => 'Criteria 3', 'keterangan' => 'Risiko investasi', 'tipe' => 'benefit'],
    ];

    public static function getAllCriteria()
    {
        return self::$criteria;
    }
    public function getCriteriaById($id)
    {
        return collect(self::$criteria)->firstWhere('id', $id);
    }
    public function createCriteria($data)
    {
        $newCriteria = [
            'id' => count(self::$criteria) + 1,
            'name' => $data['name'],
            'weight' => $data['weight']
        ];
        self::$criteria[] = $newCriteria;
        return $newCriteria;
    }   
    public function updateCriteria($id, $data)
    {
        $index = collect(self::$criteria)->search(fn($c) => $c['id'] == $id);
        if ($index === false) {
            return null;
        }
        self::$criteria[$index]['name'] = $data['name'] ?? self::$criteria[$index]['name'];
        self::$criteria[$index]['weight'] = $data['weight'] ?? self::$criteria[$index]['weight'];
        return self::$criteria[$index];
    }
    public function deleteCriteria($id)
    {
        $index = collect(self::$criteria)->search(fn($c) => $c['id'] == $id);
        if ($index === false) {
            return false;
        }
        array_splice(self::$criteria, $index, 1);
        return true;
    }
}