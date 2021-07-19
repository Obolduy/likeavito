<div class="user">
    <?php foreach($user as $elem): ?>
    <?php if ($elem['avatar'] != null): ?>
    <div><img src="http://likeavito/img/users/<?= $elem['id'] ?>/<?= $elem['avatar'] ?>" alt="Аватар" height=10% width=15%></div>
    <?php endif; ?>
    <div class="login">Логин: <?= $elem['login'] ?></div>
    <div class="email">Email: <?php echo $elem['email']; if ($elem['active'] == 0) echo ' (Не подтвержден)';  ?></div>
    <div class="name">Имя: <?= $elem['name'] ?></div>
    <div class="surname">Фамилия: <?= $elem['surname'] ?></div>
    <div class="city">Город: <?= $elem['city'] ?></div>
    <div class="registration_time">Дата регистрации: <?= $elem['registration_time'] ?></div>
    <?php endforeach; ?>
    <div class="change_user_data"><a href="/user/change">Изменить данные</a></div>
    <div class="show_user_comments"><a href="/user/showcomments">Мои комментарии</a></div>
    <div class="show_user_lots"><a href="/user/showlots">Мои объявления</a></div>
    <?php if ($_SESSION['user']['status_id'] == 2): ?><div class="admin"><a href="/admin">Вход в админ панель</a></div><?php endif;?>
</div>