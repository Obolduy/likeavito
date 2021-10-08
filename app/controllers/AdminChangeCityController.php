<?php
namespace App\Controllers;

use App\Models\CitiesGet;
use App\Models\CitiesManipulate;
use App\View\View;

class AdminChangeCityController
{  
    public static function adminShowCitiesTable(): void
    {
        $cities = (new CitiesGet)->getAllCities();

        new View('adminshowcities', ['cities' => $cities, 'title' => 'Просмотр городов']);
    }

    public static function adminChangeCity(int $city_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $city = (new CitiesGet)->getCity($city_id);

            new View('adminchangecity', ['city' => $city, 'title' => 'Изменение города']);
        } else {
            (new CitiesManipulate)->changeCity($city_id, trim(strip_tags($_POST['city'])));

            header("Location: /admin/change/city/$city_id");
        }
    }
}