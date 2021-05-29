<div class="lot">
    <?php foreach($pictures as $elem): ?>
    <div><img src="http://likeavito/img/lots/<?= $elem['lot_id'] ?>/<?= $elem['picture'] ?>" alt="Картинки"></div>
    <?php endforeach; ?>
    <?php foreach($lot as $elem): ?>
    <div class="title"><?= $elem['title'] ?></div>
    <div class="price">Цена: <?= $elem['price'] ?>₽</div>
    <div class="description"><?= $elem['description'] ?></div>
    <div class="add_time">Добавлено: <?= $elem['add_time'] ?></div>
    <div class="owner_id"><a href="/users/<?= $elem['owner_id'] ?>"><?= $elem['login'] ?></a></div>
    <?php endforeach; ?>
</div>
<div class="comments">
<br>Отзывы на товар:
<form method="POST" action="/category/<?= $elem['category_id'] ?>/<?= $elem['id'] ?>/addcomment">
    <div>Введите текст комментария: <textarea name="description"></textarea></div>
    <div><input type="submit" name="submit"></div>
</form><br>
<?php foreach ($comments as $comment): ?>
    <div class="description"><?= $comment['description'] ?></div>
    <div class="add_time">Добавлено: <?= $comment['add_time'] ?></div>
    <br>
<?php endforeach; ?>
</div>