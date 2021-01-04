<?php
require_once 'classes.php';
$pageTitle = 'Войти';

$content = '
<form method="post">
    <p>Введите логин: <input type="text" name="login"></p>
    <p>Введите пароль: <input type="password" name="password"></p>
    <p><input type="submit" name="submit"></p>
</form>';

if ($_POST['submit']) {
    $user = new User();
    $user->logIn();
}
include 'layout.php';