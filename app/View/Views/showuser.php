<div class="user">
    <?php if ($user['avatar'] != null): ?>
    <div><img src="<?= "http://{$_SERVER['SERVER_NAME']}/img/users/{$user['id']}/{$user['avatar']}" ?>" alt="Аватар" height=10% width=15%></div>
    <?php endif; ?>
    <div class="login">Логин: <?= $user['login'] ?></div>
    <div class="email">Email: <?php echo $user['email']; if ($user['active'] == 0) echo ' (Не подтвержден)';  ?></div>
    <div class="name">Имя: <?= $user['name'] ?></div>
    <div class="surname">Фамилия: <?= $user['surname'] ?></div>
    <div class="city">Город: <?= $user['city'] ?></div>
    <div class="registration_time">Дата регистрации: <?= $user['registration_time'] ?></div>
    <div class="change_user_data"><a href="/user/change">Изменить данные</a></div>
    <div class="show_user_comments"><a href="/user/showcomments">Мои комментарии</a></div>
    <div class="show_user_lots"><a href="/user/showlots">Мои объявления</a></div>
    <?php if ($user['status_id'] == 2): ?><div class="admin"><a href="/admin">Вход в админ панель</a></div><?php endif;?>
</div>