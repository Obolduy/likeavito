<?php
// require_once 'vendor/autoload.php';
// use App\Models\Lots;
// session_start();

// $lot = new Lots();
// echo $lot->addLot('dfdfd', 84, 'dfsdfdf', 1, 20);

// $rand = rand();
// mkdir("img/lots/$rand");
// $dir = "img/lots/$rand";
// $ext = '';

// if($_POST['submit']) {
//     for($i = 0; $i <= count($_FILES['photos']); $i++) {
//         preg_match_all('#\.[A-Za-z]{3,4}$#', $_FILES['photos']['name'][$i], $ext);
//         $name = md5($_FILES['photos']['name'][$i]) . $ext[0][0];
//         move_uploaded_file($_FILES['photos']['tmp_name'][$i], "$dir/$name");
//     }
// }
// preg_match_all('#\.[A-Za-z0-9]{3,4}$#', $test, $match);

// var_dump($match);

// echo $_SERVER['REQUEST_URI'] . '<br>';
// preg_match_all('#[A-Za-z0-9_-]+#', $_SERVER['REQUEST_URI'], $matches);

// чтоб в ключи массива записывал те перед которыми есть :

// for ($i = 0; $i <= (count($matches) + 1); $i++) {
//     echo $matches[0][$i]. '<br>';
// }
