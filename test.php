<?php

//require_once 'classes.php';
//session_start();

// $base = new Base();
// $test = $base->getOne('users', $login, 'login');

echo modules\classes\AuthMiddleware::authenticateMiddleware($_SERVER['REQUEST_URI']);