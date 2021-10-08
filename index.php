<?php
ini_set('display_errors', 'off');

use App\Controllers\LoginController;
use App\Router\Router;

session_start();
require_once 'vendor/autoload.php';

$routes = require 'App/routes.php';

if ($_COOKIE['remember_token']) {
    LoginController::loginByRememberToken($_COOKIE['remember_token']);
}

try {
    echo ( new Router )->checkRoute($routes);
} catch (TypeError $ex) {
    if (substr($_SERVER['REQUEST_URI'], 1, 3) == 'api') {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        )); 
    } else {
        echo ( new Router )->checkRoute(['404']);
    }
}