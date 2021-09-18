<div class="user">
    <?php if ($user['avatar'] != null): ?>
    <div><img src="/img/users/<?= $user['id'] ?>/<?= $user['avatar'] ?>" alt="Аватар" height=10% width=15%></div>
    <?php endif; ?>
    <div class="login">Логин: <?= $user['login'] ?></div>
    <div class="name">Имя: <?= $user['name'] ?></div>
    <div class="surname">Фамилия: <?= $user['surname'] ?></div>
    <div class="city">Город: <?= $user['city'] ?></div>
    <div class="registration_time">Дата регистрации: <?= $user['registration_time'] ?></div>
    <div class="start_chat"><a href="/chat/<?= $user['id'] ?>">Написать письмо</a></div>
</div>