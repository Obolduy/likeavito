<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class MainPageController
{   
    public static function showLots()
    {
        $lots = ( new Lots )->getAll('lots');

        new View('main', ['lots' => $lots]);
    }
}