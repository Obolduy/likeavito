<?php
namespace App\Controllers;

use App\Models\ApiLotGet;

class ApiGetLotController
{  
    /**
     * Show all user`s lots by user`s id
     * @param int user`s id
     * @return string JSON \w lots 
     */

    public static function apiGetUsersLots(int $user_id)
    {
        $lot = new ApiLotGet();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->getUserLots($user_id);
    }

    /**
     * Get lot by id
     * @param int lot`s id
     * @return string JSON \w lot information 
     */

    public static function apiGetLot(int $lot_id)
    {
        $lot = new ApiLotGet();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->getLot($lot_id);
    }
}