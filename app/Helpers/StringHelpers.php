<?php

namespace App\Helpers;

class StringHelpers
{
    public static function generateNewId($prefix, $latestId)
    {
        $latestNumber = $latestId ? (int) str_replace($prefix, '', $latestId) : 0;
        $newNumber = $latestNumber + 1;

        return $prefix . $newNumber;
    }
}
