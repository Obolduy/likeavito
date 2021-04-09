<?php
session_start();

require_once 'vendor/autoload.php';

use App\Router\Router;

$routes = require 'App/routes.php';

echo ( new Router )->checkRoute($routes);