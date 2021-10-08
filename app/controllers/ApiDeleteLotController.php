<?php
namespace App\Controllers;

use App\Models\ApiLotManipulate;

class ApiDeleteLotController
{  
    /**
     * Delete lot by id
     * @param int lot`s id
     * @return string JSON \w information 
     */

    public static function apiDeleteLot(int $lot_id)
    {
        $lot = new ApiLotManipulate();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->deleteLot($lot_id);
    }
}