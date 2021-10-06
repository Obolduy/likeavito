<?php
if ($_SESSION['admin_err_msg']) {
    echo $_SESSION['admin_err_msg'];

    unset($_SESSION['admin_err_msg']);
}
?>
<div>
    <form method="POST">
        <div>Пароль: <input type="password" name="password" required></div>
        <div><input type="submit" name="submit"></div>
    </form>
</div>