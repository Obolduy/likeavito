<?php
if ($_SESSION['user_err_msg']) {
    foreach ($_SESSION['user_err_msg'] as $elem) {
        echo $elem;   
    }

    unset($_SESSION['user_err_msg']);
}
?>
<form enctype="multipart/form-data" method="POST">
    <div>Введите логин: <input type="text" name="login" value="<?= $user['login'] ?>" required></div>
    <div>Введите email: <input type="text" name="email" value="<?= $user['email'] ?>" required></div>
    <div>Обновите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></div>
    <div>Введите имя: <input type="text" name="name" value="<?= $user['name'] ?>" required></div>
    <div>Введите фамилию: <input type="text" name="surname" value="<?= $user['surname'] ?>" required></div>
    <div>Введите новый пароль (по желанию): <input type="password" name="password"></div>
    <div>Подтвердите пароль (по желанию): <input type="password" name="confirmPassword"></div>
    <div><select name="city_id">
        <?php foreach ($cities as $city): ?>
        <option value="<?= $city['id'] ?>" <?php if ($user['city_id'] == $city['id']) echo 'selected'; ?>><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div><input type="submit" name="submit"></div>
</form>