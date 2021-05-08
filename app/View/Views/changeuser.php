<form enctype="multipart/form-data" method="POST">
    <?php foreach($user as $elem): ?>
    <div>Введите логин: <input type="text" name="login" value="<?= $elem['login'] ?>" required></div>
    <div>Введите email: <input type="text" name="email" value="<?= $elem['email'] ?>" required></div>
    <div>Обновите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></div>
    <div>Введите имя: <input type="text" name="name" value="<?= $elem['name'] ?>" required></div>
    <div>Введите фамилию: <input type="text" name="surname" value="<?= $elem['surname'] ?>" required></div>
    <div>Введите пароль: <input type="password" name="password" required></div>
    <div>Подтвердите пароль: <input type="password" name="confirmPassword" required></div>
    <div><select name="category_id">
        <?php foreach ($cities as $city): ?>
        <option value="<?= $city['id'] ?>" <?php if ($elem['city_id'] == $city['id']) {echo 'selected';} ?>><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <?php endforeach; ?>
    <div><input type="submit" name="submit"></div>
</form>