<?php
use App\Router\Router;

session_start();
require_once 'vendor/autoload.php';

$routes = require 'App/routes.php';

echo ( new Router )->checkRoute($routes);