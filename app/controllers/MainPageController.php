<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class MainPageController
{   
    public function showLots()
    {
        $lots = ( new Lots )->getAllLots();

        new View('main');
    }
}