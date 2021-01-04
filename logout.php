<?php
session_start();

$_SESSION['userauth'] = null;

header('Location: index.php'); die();