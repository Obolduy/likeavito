<?php

require 'C:\OpenServer\domains\likeavito\app\controllers\TestController.php';
class Router
{
    public function checkRoute($routes)
    {
        foreach ($routes as $elem) {
            if ($elem->uri == $_SERVER['REQUEST_URI']) {
                $method = $elem->method;
                $controller = new $elem->controller;
                return $controller->$method();
            }
        }
    }
    public function testCheck()
    {
        return 'euguergeuwij';
    }
}