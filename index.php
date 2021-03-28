<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once 'classes.php';

session_start();

$pageTitle = 'Главная страница';

$lots = new Lots();

$content = $lots->showAllLots();

if (!empty($_GET['tag'])) {
    $tag = $_GET['tag'];

    $content = $lots->showTag($tag);
}

echo 'ВЛАДИК СДЕЛАЙ ВСЕ КРАСИВО ИСПРАВЬ ВЕРСТКУ А ЕЩЕ ИЗМЕНЕНИЕ ПАРОЛЯ И ПО ПАПКАМ РАСКИДАЙ КРАСИВО';

include 'layout.php';
?>