<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// require_once 'classes.php';

session_start();

var_dump($_SESSION['user']);

// $pageTitle = 'Главная страница';

// $lots = new Lots();

// $content = $lots->showAllLots();

// if (!empty($_GET['tag'])) {
//     $tag = $_GET['tag'];

//     $content = $lots->showTag($tag);
// }

// include 'layout.php';
?>