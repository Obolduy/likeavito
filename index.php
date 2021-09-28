<?php
// ini_set('display_errors', 'off');

use App\Models\UserGet;
use App\Router\Router;

session_start();
require_once 'vendor/autoload.php';

$routes = require 'App/routes.php';

if ($_COOKIE['remember_token']) {
    $_SESSION['userauth'] = true;
    $userId = (new UserGet)->getUserIdByToken($_COOKIE['remember_token']);

    $_SESSION['user']['id'] = $userId;
}

if ($_SESSION['user']['id']) {
    $user = (new UserGet)->getUser($_SESSION['user']['id']);

    $_SESSION['user'] = ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email']];
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