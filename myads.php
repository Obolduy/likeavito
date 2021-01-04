<?php
require_once 'classes.php';

session_start();

$user_id = $_SESSION['user_id'];
$lot_id = $_GET['edit'];

$lots = new Lots();

include 'myarea.php';

echo $lots->joinColumn($user_id);

if (!empty($lot_id)) {
    echo $lots->getForm($lot_id);
}

if ($_POST['submit']) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $lots->changeLot($title, $price, $description, $lot_id);
}
if ($_POST['delete'] == 1) {
    $lots->deleteLot($lot_id);
}

// ПРИ НАЖАТИИ НА КНОПКУ ОН ОБНОВЛЯЕТ ЕЩЕ И АПДЕЙТТАЙМ ЕЩЕ И РАДИО ПЕРЕКЛЮЧАТЕЛЬ ОТОБРАЖАТЬ ИЛИ НЕТ