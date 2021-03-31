<?php
namespace App\Router;

class Router
{
    public function checkRoute($routes)
    {
        foreach ($routes as $elem) {
            if ($elem->uri == $_SERVER['REQUEST_URI']) {
                return call_user_func($elem->callable);
            }
        }
    }
}