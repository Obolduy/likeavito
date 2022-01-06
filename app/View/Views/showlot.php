<div class="lot">
    <div id="imagelist">
        <div id="images">
            <?php foreach ($pictures as $elem): ?>
            <div class="image" style="display: none;">
                <img height=50% width=40% src="<?= "http://{$_SERVER['SERVER_NAME']}/img/lots/{$elem['lot_id']}/{$elem['picture']}" ?>" alt="Картинки">
            </div>
            <?php endforeach; ?>
        </div>
        <div id="images__minor" style="display:flex; height:60%; width:60%;">
            <?php foreach ($pictures as $elem): ?>
            <div class="image__minor" style="margin:1% 5% 3% 0;">
                <img height=100% width=100% src="<?= "http://{$_SERVER['SERVER_NAME']}/img/lots/{$elem['lot_id']}/{$elem['picture']}" ?>" alt="Картинки">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="title"><?= $lot['title'] ?></div>
    <div class="price">Цена: <?= $lot['price'] ?>₽</div>
    <div class="description"><?= nl2br($lot['description']) ?></div>
    <div class="add_time">Добавлено: <?= $lot['add_time'] ?></div>
    <div class="owner_id"><a href="/users/<?= $lot['owner_id'] ?>"><?= $lot['login'] ?></a></div>
</div>
<div class="comments">
<br>Отзывы на товар:
<form method="POST" action="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>/addcomment">
    <div>Введите текст комментария: <textarea name="description" <?php if (!$_SESSION['userauth']): ?> disabled placeholder="Пожалуйста, войдите, чтобы оставлять комментарии" <?php endif; ?> required></textarea></div>
    <div><input type="submit" name="submit" value="Отправить комментарий" <?php if (!$_SESSION['userauth']): ?> disabled <?php endif; ?>></div>
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

<script src="/js/lotimagesview.js"></script>