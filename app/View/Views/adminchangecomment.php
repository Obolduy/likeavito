<form method="POST">
    <div>Введите описание: <textarea name="description"><?= $comment['description'] ?></textarea></div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_comments"><a href="/admin/delete/comment/<?= $comment['id'] ?>">Удалить комменатрий</a></div>