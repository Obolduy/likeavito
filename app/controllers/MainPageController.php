<?php
namespace App\Controllers;
use App\Models\Lots;

class MainPageController
{   
    public function showLots()
    {
        $lots = ( new Lots )->getAllLots();

        include 'mainpage.php';
    }
}