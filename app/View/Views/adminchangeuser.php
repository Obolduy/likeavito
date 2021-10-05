<?php
if ($_SESSION['user_err_msg']) {
    foreach ($_SESSION['user_err_msg'] as $elem) {
        echo $elem;   
    }

    unset($_SESSION['user_err_msg']);
}
?>
<form method="POST">
    <div>Введите логин: <input type="text" name="login" value="<?= $user['login'] ?>" required></div>
    <div>Введите Email: <input type="text" name="email" value="<?= $user['email'] ?>" required></div>
    <div>Введите имя: <input type="text" name="name" value="<?= $user['name'] ?>" required></div>
    <div>Введите фамилию: <input type="text" name="surname" value="<?= $user['surname'] ?>" required></div>
    <div><select name="city_id">
        <?php foreach ($cities as $city): ?>
        <option value="<?= $city['id'] ?>" <?php if ($user['city_id'] == $city['id']) {echo 'selected';} ?>><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div><br>
    <div>
        <div>Управление баном пользователя:</div>
        <div><input name="ban_status" type="radio" value="0"<?php if ($user['ban_status'] == 0) {echo " checked";} ?>> Не забанен</div>
        <div><input name="ban_status" type="radio" value="1"<?php if ($user['ban_status'] == 1) {echo " checked";} ?>> Забанен</div>
    </div><br>
    <div>
        <div>Управление уровнем доступа пользователя:</div>
        <div><input name="admin_status" type="radio" value="1"<?php if ($user['status_id'] == 1) {echo " checked";} ?>> Пользователь</div>
        <div><input name="admin_status" type="radio" value="2"<?php if ($user['status_id'] == 2) {echo " checked";} ?>> Администратор</div>
    </div><br>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_del_link"><a onclick="confirmDeleteUser()" href="/admin/delete/user/<?= $user['id'] ?>">Удалить пользователя</a></div>
<script type="text/javascript">
    function confirmDeleteUser() {
        if (confirm("Вы уверены, что хотите удалить пользователя <?php echo $user['login']; ?>?")) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>