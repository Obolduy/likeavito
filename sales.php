<?php
require_once 'classes.php';

session_start();

$pageTitle = 'Товары';


$lots = new Lots();

$content = $lots->showLots();

include 'layout.php';