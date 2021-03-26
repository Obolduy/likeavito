<?php
require_once 'classes.php';

//session_start();

$user = new User(1);

$_SESSION['user'] = $user->data;

var_dump($_SESSION['user']);