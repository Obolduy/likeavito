<?php
require_once 'classes.php';

//session_start();

$base = new Base();
$test = $base->getOne('users', $login, 'login');
if (!empty($test)) {
    echo 'Не пустой';
} else {
    echo 'пустой';
}