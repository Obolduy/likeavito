<?php
namespace App\Controllers;

use App\View\View;
use App\Models\CitiesManipulate;

class AdminAddCityController
{   
    public static function addCity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('addcity', ['title' => 'Добавление города']);
        } else {
            (new CitiesManipulate)->addCity(strip_tags(trim($_POST['city'])));
            
            header("Location: /");
        }
    }
}