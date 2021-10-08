<?php
namespace App\Controllers;

use App\Models\Cities;
use App\View\View;

class AdminChangeCityController
{  
    public static function adminShowCitiesTable(): void
    {
        $cities = (new Cities)->getAllCities();

        new View('adminshowcities', ['cities' => $cities, 'title' => 'Просмотр городов']);
    }

    public static function adminChangeCity(int $city_id): void
    {
        $cities = new Cities();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $city = $cities->getCity($city_id);

            new View('adminchangecity', ['city' => $city, 'title' => 'Изменение города']);
        } else {
            $cities->changeCity($city_id, trim(strip_tags($_POST['city'])));

            header("Location: /admin/change/city/$city_id");
        }
    }
}