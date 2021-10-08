<?php
namespace App\Controllers;

use App\Models\CitiesManipulate;

class AdminDeleteCityController
{   
    public static function adminDeleteCity(int $city_id): void
    {
        (new CitiesManipulate)->deleteCity($city_id);
        
        header('Location: /admin/cities');
    }
}