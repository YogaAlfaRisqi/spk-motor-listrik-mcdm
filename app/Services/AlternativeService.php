<?php

namespace App\Services;

class AlternativeService
{
    private static array $alternatives = [
       
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