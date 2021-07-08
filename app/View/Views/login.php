<?php
if ($_SESSION['login_err_msg']) {
    echo $_SESSION['login_err_msg'];

    unset($_SESSION['login_err_msg']);
}
?>
<br>
<form method="POST">
    <div>Логин: <input type="text" name="login"></div>
    <div>Пароль: <input type="password" name="password"></div>
    <div><input type="checkbox" name="remember_me" value="1"> Запомнить меня</div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="forget__pass"><a href="/user/resetpassword">Забыли пароль?</a></div>