<div class="user">
    <?php foreach($user as $elem): ?>
    <?php if ($elem['avatar'] != null): ?>
    <div><img src="/img/users/<?= $elem['id'] ?>/<?= $elem['avatar'] ?>" alt="Аватар" height=10% width=15%></div>
    <?php endif; ?>
    <div class="login">Логин: <?= $elem['login'] ?></div>
    <div class="name">Имя: <?= $elem['name'] ?></div>
    <div class="surname">Фамилия: <?= $elem['surname'] ?></div>
    <div class="city">Город: <?= $elem['city'] ?></div>
    <div class="registration_time">Дата регистрации: <?= $elem['registration_time'] ?></div>
    <div class="start_chat"><a href="/chat/<?= $elem['id'] ?>">Написать письмо</a></div>
    <?php endforeach; ?>
</div>