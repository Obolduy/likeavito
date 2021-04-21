<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class ShowLotController
{   
    public function showLot(int $category_id, int $lot_id)
    {
        $lots = ( new Lots )->getOne('lots', $id);

        new View('lot');
    }
}