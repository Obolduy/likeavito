<?php

require_once 'app/models/Base.php';
//session_start();

// $base = new Base();

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
?>

<form method="post" enctype="multipart/form-data">
    <p>Фото: <input type="file" accept="image/*" name="photos[]" multiple></p>
    <p><input type="submit" name="submit" value="Добавить объявление"></p>
</form>