<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class AdminDeleteLotController
{   
    public static function adminDeleteLot(int $lot_id): void
    {
        $lot = new Lots;

        $pictures = $lot->getOne('lots_pictures', $lot_id, 'lot_id');

        foreach ($pictures as $elem) {
            $id = $elem['id'];
        }

        if (is_dir($_SERVER['DOCUMENT_ROOT'] . "img/lots/$lot_id")) {
            rmdir($_SERVER['DOCUMENT_ROOT'] . "img/lots/$lot_id");
        }

        if ($id != null) {
            $lot->delete('lots_pictures', $lot_id, 'lot_id');
        }

        $lot->delete('lots', $lot_id);

        header('Location: /');
    }
}