<?php

namespace App\Helpers;
use App\Helpers as HelperModel;;

class Helper
{
    /**
     * Foo constructor.
     */
    public static function strUp(string $string)
    {
        return strtoupper($string);
    }


    public static function getFeaturedStores()
    {
        $products = HelperModel::all(); 

       return $products;
    }
} 