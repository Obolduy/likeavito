<?php
session_start();
$_SESSION['check'] = false;

require_once 'vendor/autoload.php';

use App\Router\Router;

$routes = require 'App/routes.php';

echo ( new Router )->checkRoute($routes);