<?php
namespace App\Controllers;

use App\Models\ApiLotManipulate;
use App\Models\ApiUserGet;
use App\Models\ApiLotValidate;

class ApiChangeLotController
{  
    /**
     * Change lot by id
     * @param int lot`s id
     * @return string JSON \w information 
     */

    public static function apiChangeLot(int $lot_id)
    {
        $userId = (new ApiUserGet)->getIdViaToken($_COOKIE['api_token']);

        if ((new ApiLotValidate)->checkOwnerId($userId, $lot_id)) {
            $lot = new ApiLotManipulate();

            header('HTTP/1.0 201');
            header('Content-Type: application/json; charset=UTF-8');
        
            echo $lot->changeLot($lot_id, json_decode(file_get_contents('php://input'), true));
        } else {
            header('HTTP/1.0 201');
            header('Content-Type: application/json; charset=UTF-8');

            echo json_encode(['Error!' => 'This isn\'t youre lot'], JSON_UNESCAPED_UNICODE);
        }
    }
}