<form method="POST">
    <div>Введите описание: <textarea name="description" required><?= $comment['description'] ?></textarea></div>
    <div><input type="checkbox" name="display" value="1" checked>Отображать комментарий</div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_comments"><a href="/deletecomment/<?= $comment['id'] ?>">Удалить комменатрий</a></div>