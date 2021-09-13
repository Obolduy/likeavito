<?php
namespace App\Controllers;

use App\Models\LotManipulate;

class AdminDeleteLotController
{   
    public static function adminDeleteLot(int $lot_id): void
    {
        (new LotManipulate)->deleteLot($lot_id);

        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}