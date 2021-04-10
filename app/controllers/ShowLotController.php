<?php
namespace App\Controllers;
use App\Models\Lots;

class ShowLotController
{   
    public function showLot(int $category_id, int $lot_id)
    {
        $lots = ( new Lots )->showLot($id);

        include_once $_SERVER['DOCUMENT_ROOT'] . '/App/Views/lot.php';
    }
}