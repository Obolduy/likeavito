<?php
require_once 'classes.php';
session_start();

$pageTitle = 'Добавить лот';

if ($_SESSION['userauth'] == true) {
    $content = '
    <form method="post" enctype="multipart/form-data">
        <p>Название: <input type="text" name="title"></p>
        <p>Цена: <input type="text" name="price"></p>
        <p>Описание: <input type="text" name="description"></p>
        <p>Фото ДОРАБОТАТЬ: <input type="file" accept="image/*" name="photos[]" multiple></p>
        ' . Base::getCategories() . '
        <p><input type="submit" name="submit" value="Добавить объявление"></p>
    </form>';

    if ($_POST['submit']) {
        $lot = new Lots();
        $lot->newLot();
    }

    include 'layout.php';
} else {
    header('Location: login.php'); die();
}