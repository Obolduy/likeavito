<?php
namespace App\Controllers;
use App\Models\Lots;

class MainPageController
{   
    public function showLots()
    {
        $lots = ( new Lots )->getAllLots();

        include_once $_SERVER['DOCUMENT_ROOT'] . '/App/Views/mainpage.php';
    }
}