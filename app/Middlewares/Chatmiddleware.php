<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;

class Chatmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (preg_match("#{$_SESSION['user']['id']}$#", $_SERVER['REQUEST_URI'])) {
            header('Location: /');
        }
    }
}