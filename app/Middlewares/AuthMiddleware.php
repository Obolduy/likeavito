<?php
namespace App\Middlewares;
use App\Middlewares\IMiddleware;

class Authmiddleware implements IMiddleware
{    
    public function middleware($uri)
    {
        if (!isset($_SESSION['user'])) {
            $data = ['/myads.php', '/add.php', '/myarea.php', '/logout.php'];

            $flag = 0;

            foreach ($data as $elem) {
                if ($elem === $uri) {
                    $flag = 1;
                }
            }

            if ($flag == 1) {
                header('Location: /login.php');
            }
        } else {
            $data = ['/registration.php', '/login.php', '/password_reset.php'];

            $flag = 0;

            foreach ($data as $elem) {
                if ($elem === $uri) {
                    $flag = 1;
                }
            }

            if ($flag == 1) {
                header('Location: /');
            }
        }
    }
}