<?php
namespace App\Controllers;

use App\Models\LotManipulate;

class DeleteLotController
{   
    public static function deleteLot(int $lot_id): void
    {
        (new LotManipulate)->deleteLot($lot_id);
    }
}