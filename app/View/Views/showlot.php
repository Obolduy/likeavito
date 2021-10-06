<div class="lot">
    <?php foreach ($pictures as $elem): ?>
    <div><a href="<?= "http://{$_SERVER['SERVER_NAME']}/img/lots/{$elem['lot_id']}/{$elem['picture']}" ?>" target="_blank"><img height=50% width=40% src="<?= "http://{$_SERVER['SERVER_NAME']}/img/lots/{$elem['lot_id']}/{$elem['picture']}" ?>" alt="Картинки"></a></div>
    <?php endforeach; ?>
    <div class="title"><?= $lot['title'] ?></div>
    <div class="price">Цена: <?= $lot['price'] ?>₽</div>
    <div class="description"><?= nl2br($lot['description']) ?></div>
    <div class="add_time">Добавлено: <?= $lot['add_time'] ?></div>
    <div class="owner_id"><a href="/users/<?= $lot['owner_id'] ?>"><?= $lot['login'] ?></a></div>
</div>
<div class="comments">
<br>Отзывы на товар:
<form method="POST" action="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>/addcomment">
    <div>Введите текст комментария: <textarea name="description" required></textarea></div>
    <div><input type="submit" name="submit"></div>
</form><br>
<?php foreach ($comments as $comment): ?>
<div class="comment_autor">
    <?php if ($comment['avatar']): ?>
    <img src="<?= "http://{$_SERVER['SERVER_NAME']}/img/users/{$comment['user_id']}/{$comment['avatar']}" ?>" alt="Аватар" height=5% width=5%>
    <?php endif; ?>
    <a href="<?= "/users/{$comment['user_id']}" ?>"><?= $comment['login'] ?></a>
</div>
<div class="description"><?= nl2br($comment['description']) ?></div>
<div class="add_time">Добавлено: <?php echo $comment['add_time']; if ($_SESSION['user']['id'] == $comment['user_id']) echo "<a href=\"/changecomment/{$comment['id']}\"> Отредактировать</a>" ?></div>
<br>
<?php endforeach; ?>
</div>