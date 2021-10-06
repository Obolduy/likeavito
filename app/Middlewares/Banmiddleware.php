<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;

class Banmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if ($_SESSION['user']['ban_status'] == 1) {
            $_SESSION['main_err_msg'] = ['Вы были забанены администрацией.'];
            
            header('Location: /'); die();
        }
    }
}