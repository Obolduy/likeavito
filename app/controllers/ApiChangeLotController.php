<?php
namespace App\Controllers;
use App\Models\LotsApi;

class ApiChangeLotController
{  
    public static function apiChangeLot(int $lot_id)
    {
        $lot = new LotsApi();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $lot->changeLot($lot_id, json_decode(file_get_contents('php://input'), true));
    }
}