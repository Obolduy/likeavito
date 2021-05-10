<?php
namespace App\Controllers;
use App\Models\LotsApi;

class ApiChangeLotController
{  
    public static function apiChangeLot(int $lot_id, $data)
    {
        $lot = new LotsApi();

        // header('HTTP/1.0 201');
        // header('Content-Type: application/json; charset=UTF-8');
        preg_replace();
    
        echo $lot->changeLot($lot_id, $data); // заменить символы на нужные регуляркой
    }
}