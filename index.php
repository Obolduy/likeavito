<?php
require_once 'vendor/autoload.php';
use App\Router\Router;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$routes = require 'App/routes.php';
echo ( new Router )->checkRoute($routes); //
?>