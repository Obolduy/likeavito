<?php
require_once 'classes.php';

//session_start();

$test = new Base();
$info = $test->getAll('categories');
foreach($info as $elem) {
    $res = $elem['category'];
}
echo $res;
