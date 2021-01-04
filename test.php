<?php
//require_once 'classes.php';

//session_start();

if ($_POST['submit']) {

    $path = 'img/';
 
    if ($_POST['submit'])
    {
    if (!@copy($_FILES['photo']['tmp_name'], $path . ))
    echo 'Что-то пошло не так';
    else
    copy($_FILES['photo']['tmp_name'], $path . $_FILES['photo']['name'])
    }
    echo '<img src="img/dsf.png" alt="text">';
    
    
   /* $picture = $_POST['photo'];
    $file = $_FILES['photo'];

    file_put_contents('4.png', $file);*/
}
?>
<form method=POST enctype="multipart/form-data">
    <input type="text" name="title" value="{$lot['title']}"><br><br>
    <input type="text" name="price" value="{$lot['price']}"><br><br>
    <textarea name="description" placeholder="type text">Тест</textarea><br><br>
    <input type="file" accept="image/*" name="photo">
    <input name="delete" type="checkbox" value="1"> Удалить <br><br>
    <input type="submit" name="submit">
</form>