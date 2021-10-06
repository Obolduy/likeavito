<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;

class Apiauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (!isset($_COOKIE['api_token'])) {
            header('HTTP/1.0 200');
            header('Content-Type: application/json; charset=UTF-8');
            
            echo json_encode(["error" => "Please, log in"]); die();
        }
    }
}