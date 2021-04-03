<?php
namespace App\Controllers;
use App\Models\Lots;

class MainPageController
{   
    public function showLot(int $id)
    {
        $lots = ( new Lots )->showLot($id);

        include 'lot.php';
    }
}