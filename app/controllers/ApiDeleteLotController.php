<?php
namespace App\Controllers;
use App\Models\LotsApi;

class ApiDeleteLotController
{  
    public static function apiDeleteLot(int $lot_id)
    {
        $lot = new LotsApi();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->deleteLot($lot_id);
    }
}