<div class="user">
    <?php foreach($user as $elem): ?>
    <?php if ($elem['avatar'] != null): ?>
    <div><img src="/img/users/<?= $elem['id'] ?>/<?= $elem['avatar'] ?>" alt="Аватар"></div>
    <?php endif; ?>
    <div class="login">Логин: <?= $elem['login'] ?></div>
    <div class="name">Имя: <?= $elem['name'] ?></div>
    <div class="surname">Фамилия: <?= $elem['surname'] ?></div>
    <div class="city">Город: <?= $elem['city'] ?></div>
    <div class="registration_time">Дата регистрации: <?= $elem['registration_time'] ?></div>
    <?php endforeach; ?>
</div>