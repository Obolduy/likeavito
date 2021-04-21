<?php
namespace App\Controllers;
use App\Models\Lots;

class DeleteLotController
{   
    public function deleteLot(int $lot_id): void
    {
        $base = new Lots();
        
        $base->delete('lots_pictures', $lot_id, 'lot_id');
        $base->delete('lots', $lot_id);

        if (is_dir($_SERVER['DOCUMENT_ROOT'] . "img/lots/$lot_id")) {
            rmdir($_SERVER['DOCUMENT_ROOT'] . "img/lots/$lot_id");
        }
    }
}