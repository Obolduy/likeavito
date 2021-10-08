<?php
namespace App\Controllers;

use App\Models\Cities;

class AdminDeleteCityController
{   
    public static function adminDeleteCity(int $city_id): void
    {
        (new Cities)->deleteCity($city_id);
        
        header('Location: /admin/cities');
    }
}