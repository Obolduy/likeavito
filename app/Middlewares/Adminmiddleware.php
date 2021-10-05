<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;
use App\Models\UserGet;

class Adminmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        $user = (new UserGet)->getUser($_SESSION['user']['id']);

        if ($user['status_id'] != 2) {
            header('Location: /');
        }
    }
}