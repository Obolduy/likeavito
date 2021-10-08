<?php
namespace App\Controllers;

use App\View\View;
use App\Models\Cities;

class AdminAddCityController
{   
    public static function addCity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('addcity', ['title' => 'Добавление города']);
        } else {
            (new Cities)->addCity(strip_tags(trim($_POST['city'])));
            
            header("Location: /");
        }
    }
}