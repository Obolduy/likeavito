<?php
session_start();
require_once 'vendor/autoload.php';
// use App\Router\Router;
// use App\Models\Lots;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// $uri = $_SERVER['REQUEST_URI'];
// $id = 'menyaem';
// $test = '';
// preg_match('#%7B(.+)%7D#', $uri, $test);
// echo $test[1];
// var_dump($test);
$routes = require 'App/routes.php';
echo ( new Router )->checkRoute($routes); //
?>