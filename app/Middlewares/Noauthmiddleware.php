<?php
namespace App\Middlewares;
use App\Middlewares\IMiddleware;

class Noauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (!isset($_SESSION['user'])) {
            return true;
        } else {
            header('Location: /');
        }
    }
}