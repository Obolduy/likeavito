<?php

if ($_SESSION['userauth'] == true) {
    echo '<div class="loged"><p><a href="/logout.php">Выйти</a></p>';
    echo '<p><a href="/add.php">Написать объявление</a></p>';
    echo '<p><a href="/myarea.php">Личный кабинет</a></p></div>';
} else {
    echo '
    <div class="logout"><div class="reg"><p><a href="/registration.php">Зарегистрироваться</a></p></div>
    <p><div class="login"><a href="/login.php">Войти</a></p></div></div>';
}

echo '<div class="else"><p><a href="/">Главная страница</a></p>';
echo '<p><a href="/sales.php">Продажа</a></p>';
echo '<p><a href="/works.php">Услуги</a></p></div>';