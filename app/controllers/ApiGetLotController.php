<?php
namespace App\Controllers;
use App\Models\LotsApi;

class ApiGetLotController
{  
    public static function apiGetUsersLots(int $user_id)
    {
        $lot = new LotsApi();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->getUsersLots($user_id);
    }

    public static function apiGetLot(int $lot_id)
    {
        $lot = new LotsApi();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->getLot($lot_id);
    }
}