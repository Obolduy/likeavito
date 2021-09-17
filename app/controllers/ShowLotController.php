<?php
namespace App\Controllers;

use App\Models\LotGet;
use App\Models\CommentGet;
use App\View\View;

class ShowLotController
{   
    public static function showLot(int $category_id, int $lot_id): void
    {
        $lot = (new LotGet)->getFullLotInfo($lot_id);
        $comments = (new CommentGet)->getLotComments($lot_id);

        new View('showlot', ['lot' => $lot['LotInfo'], 'pictures' => $lot['LotPictures'], 'comments' => $comments, 'title' => $lot['LotInfo']['title']]);
    }
}