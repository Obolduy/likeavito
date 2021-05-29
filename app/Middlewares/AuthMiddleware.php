<?php
namespace App\Middlewares;
use App\Middlewares\IMiddleware;

class Authmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login'); die();
        }
    }
}