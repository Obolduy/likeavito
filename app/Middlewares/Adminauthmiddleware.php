<?php
namespace App\Middlewares;

use App\Middlewares\IMiddleware;

class Adminauthmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (!$_SESSION['adminauth']) {
            header('Location: /admin/login');
        }
    }
}