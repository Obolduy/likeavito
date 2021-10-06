<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;

class Authmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (!$_SESSION['user']['id']) {
            header('Location: /login'); die();
        }
    }
}