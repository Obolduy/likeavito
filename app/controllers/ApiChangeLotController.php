<?php
namespace App\Controllers;
use App\Models\LotsApi;

class ApiChangeLotController
{  
    public static function apiChangeLot(int $lot_id, $data)
    {
        $lot = new LotsApi();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
        $data = preg_replace('#%7B#', '{', $data);
        $data = preg_replace('#%7D#', '}', $data);
        $data = preg_replace('#%22#', '"', $data);
        $data = preg_replace('#%20#', ' ', $data);
    
        echo $lot->changeLot($lot_id, $data);
    }
}