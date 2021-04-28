<?php
namespace App\Middlewares;
use App\Middlewares\IMiddleware;
use App\Models\User;

class Adminmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {       
        if ($_SESSION['user']['status_id'] != 2) {
            header('Location: /');
        }
    }
}