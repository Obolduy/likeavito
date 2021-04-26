<div>
    <?php foreach($lot as $elem): ?>
    <div class="title"><?= $elem['title'] ?></div>
    <div class="price">Цена: <?= $elem['price'] ?>₽</div>
    <div class="description"><?= $elem['description'] ?></div>
    <div class="add_time">Добавлено: <?= $elem['add_time'] ?></div>
    <div class="owner_id"><a href="/user/<?= $elem['owner_id'] ?>">Добавить имя пользователя</a></div>
    <?php endforeach; ?>
</div>