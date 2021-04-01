<?php
require_once 'vendor/autoload.php';
use App\Router\Router;
use App\Models\Lots;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$lots = new Lots();
$test = $lots->selectQuery("SELECT * FROM users");
var_dump($test);
$routes = require 'App/routes.php';
//echo ( new Router )->checkRoute($routes); //
?>