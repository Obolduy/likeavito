<?php
namespace App\Controllers;

use App\Models\CommentManipulate;
use App\Models\LotManipulate;

class AdminDeleteLotController
{   
    public static function adminDeleteLot(int $lot_id): void
    {
        (new CommentManipulate)->deleteLotComments($lot_id);
        (new LotManipulate)->deleteLot($lot_id);

        header('Location: /admin/lots');
    }
}