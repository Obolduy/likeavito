<form method="POST">
    <div>Введите логин: <input type="text" name="login" required></div>
    <div>Введите email: <input type="text" name="email" required></div>
    <div>Введите Ваше имя: <input type="text" name="name" required></div>
    <div>Введите Вашу фамилию: <input type="text" name="surname" required></div>
    <div>Введите пароль: <input type="password" name="password" required></div>
    <div>Подтвердите пароль: <input type="password" name="confirmPassword" required></div>
    <div><select name="city_id">
        <?php foreach($cities as $city): ?>
        <option value="<?= $city['id'] ?>"><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div><input type="submit" name="submit"></div>
</form>