<?php
require_once 'classes.php';
session_start();
$pageTitle = 'Товар';

$id = $_GET['lot'];

$lots = new Lots();

$content = $lots->showLot($id);

include 'layout.php';