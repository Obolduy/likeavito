<form method="POST">
    <?php foreach($user as $elem): ?>
    <div>Введите логин: <input type="text" name="login" value="<?= $elem['login'] ?>" required></div>
    <div>Введите Email: <input type="text" name="email" value="<?= $elem['email'] ?>" required></div>
    <div>Введите имя: <input type="text" name="name" value="<?= $elem['name'] ?>" required></div>
    <div>Введите фамилию: <input type="text" name="surname" value="<?= $elem['surname'] ?>" required></div>
    <div><select name="city_id">
        <?php foreach ($cities as $city): ?>
        <option value="<?= $city['id'] ?>" <?php if ($elem['city_id'] == $city['id']) {echo 'selected';} ?>><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div><input name="ban_status" type="radio" value="0"<?php if ($elem['ban_status'] == 0) {echo " checked";} ?>> Не забанен</div>
    <div><input name="ban_status" type="radio" value="1"<?php if ($elem['ban_status'] == 1) {echo " checked";} ?>> Забанен</div>
    <?php endforeach; ?>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_comments"><a href="/admin/delete/user/<?= $elem['id'] ?>">Удалить пользователя</a></div>