<?php
require_once 'classes.php';

session_start();

$user = new User();

$user_id = $_SESSION['user_id'];

include 'myarea.php';

echo $user->getUserTable($user_id);

if ($_POST['submit']) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];
    $current_login = $_SESSION['user_login'];

    $check = $user->changeCheck($login, $password, $confirmPassword, $current_login);

    if ($check == true) {
        $user->changeInformation($name, $login, $password, $user_id);
    }
}