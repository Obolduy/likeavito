<?php
require_once 'classes.php';

session_start();

$pageTitle = 'Работы';

$lots = new Lots();

$content = $lots->showJobs();

include 'layout.php';