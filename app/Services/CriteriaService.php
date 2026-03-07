<?php

namespace App\Services;

class CriteriaService
{
    private static array $criteria = [
        ['id' => 1, 'name' => 'Criteria 1', 'weight' => 0.3],
        ['id' => 2, 'name' => 'Criteria 2', 'weight' => 0.5],
        ['id' => 3, 'name' => 'Criteria 3', 'weight' => 0.2],
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