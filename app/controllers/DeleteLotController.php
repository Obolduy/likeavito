<?php
namespace App\Controllers;

use App\Models\LotManipulate;
use App\Models\LotGet;

class DeleteLotController
{   
    public static function deleteLot(int $lot_id): void
    {
        $checkUser = (new LotGet)->getFullLotInfo($lot_id);

        if ($checkUser['owner_id'] == $_SESSION['user']['id']) {
            (new LotManipulate)->deleteLot($lot_id);

            header('Location: /'); die();
        }

        header('Location: /user');
    }
}