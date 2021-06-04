<?php
namespace App\Controllers;
use App\Models\Lots;
use App\Models\Comments;
use App\View\View;

class ShowLotController
{   
    public static function showLot(int $category_id, int $lot_id): void
    {
        if ($value == null) {
            $lots = new Lots;
            $lot = $lots->getFullLotInfo($lot_id);
            $pictures = $lots->getOne('lots_pictures', $lot_id, 'lot_id');

            $comments = ( new Comments )->getOne('comments', $lot_id, 'lot_id');
        }

        new View('showlot', ['lot' => $lot, 'pictures' => $pictures, 'comments' => $comments, 'title' => $lot[0]['title']]);
    }
}