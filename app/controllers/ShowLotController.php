<?php
namespace App\Controllers;
use App\Models\Lots;
use App\Models\Comments;
use App\View\View;

class ShowLotController
{   
    public static function showLot(int $category_id, int $lot_id): void
    {
        $lot = ( new Lots )->getOne('lots', $lot_id);
        $comments = ( new Comments )->getOne('comments', $lot_id, 'lot_id');

        new View('showlot', ['lot' => $lot, 'comments' => $comments, 'title' => $lot[0]['title']]);
    }
}