<?php
spl_autoload_register();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// session_start();

// var_dump($_SESSION['user']);

// $pageTitle = 'Главная страница';

// $lots = new Lots();

// $content = $lots->showAllLots();

// if (!empty($_GET['tag'])) {
//     $tag = $_GET['tag'];

//     $content = $lots->showTag($tag);
// }

// include 'layout.php';

//$uri = $_SERVER['REQUEST_URI'];
require 'app/models/router.php';

$routes = require 'app/models/routes.php';
echo ( new Router )->checkRoute($routes);
?>