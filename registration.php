<?php
require_once 'classes.php';
$pageTitle = 'Регистрация';

$content = '
<form method="post">
    <p>Введите логин: <input type="text" name="login"></p>
    <p>Введите Ваше имя: <input type="text" name="name"></p>
    <p>Введите пароль: <input type="password" name="password"></p>
    <p>Подтвердите пароль: <input type="password" name="confirmPassword"></p>
    ' . Base::getCities() . '
    <p><input type="submit" name="submit"></p>
</form>';

if ($_POST['submit']) {
    $user = new User();
    $user->registration();
}
include 'layout.php';