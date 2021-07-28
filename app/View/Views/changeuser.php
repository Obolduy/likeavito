<?php
if ($_SESSION['user_err_msg']) {
    echo $_SESSION['user_err_msg'];

    unset($_SESSION['user_err_msg']);
}
?>
<form enctype="multipart/form-data" method="POST">
    <?php foreach ($user as $elem): ?>
    <div>Введите логин: <input type="text" name="login" value="<?= $elem['login'] ?>" required></div>
    <div>Введите email: <input type="text" name="email" value="<?= $elem['email'] ?>" required></div>
    <div>Обновите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></div>
    <div>Введите имя: <input type="text" name="name" value="<?= $elem['name'] ?>" required></div>
    <div>Введите фамилию: <input type="text" name="surname" value="<?= $elem['surname'] ?>" required></div>
    <div>Введите новый пароль (по желанию): <input type="password" name="password"></div>
    <div>Подтвердите пароль (по желанию): <input type="password" name="confirmPassword"></div>
    <div><select name="city_id">
        <?php foreach ($cities as $city): ?>
        <option value="<?= $city['id'] ?>" <?php if ($elem['city_id'] == $city['id']) echo 'selected'; ?>><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <?php endforeach; ?>
    <div><input type="submit" name="submit"></div>
</form>