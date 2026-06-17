<?php

namespace App\Helpers;

class ApiMessage
{
    public static function created($entity)
    {
        return "$entity created successfully";
    }

    public static function updated($entity)
    {
        return "$entity updated successfully";
    }

    public static function deleted($entity)
    {
        return "$entity deleted successfully";
    }

    public static function fetched($entity)
    {
        return "$entity retrieved successfully";
    }
}