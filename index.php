<?php
use App\Router\Router;
use App\Models\Chat;

session_start();
require_once 'vendor/autoload.php';

$routes = require 'App/routes.php';

// try {
//     echo ( new Router )->checkRoute($routes);
// } catch (TypeError $ex) {
//     if (substr($_SERVER['REQUEST_URI'], 1, 3) == 'api') {
//         header('HTTP/1.0 400 Bad Request');
//         echo json_encode(array(
//             'error' => 'Bad Request'
//         )); 
//     } else {
//         echo ( new Router )->checkRoute(['404']);
//     }
// }
$check = new Chat();
var_dump($check->showChat(42, 43));