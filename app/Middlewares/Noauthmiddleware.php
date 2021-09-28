<?php
namespace App\Middlewares;
use App\Middlewares\IMiddleware;

class Noauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if ($_SESSION['user']['id']) {
            header('Location: /');
        }
    }
}