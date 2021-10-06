<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;

class Emailcheckmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if ($_SESSION['user']['active'] != 1) {
            header('Location: /user');
        }
    }
}