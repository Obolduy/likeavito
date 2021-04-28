<form method="POST">
    <?php foreach($comment as $elem): ?>
    <div>Введите описание: <textarea name="description"><?= $elem['description'] ?></textarea></div>
    <?php endforeach; ?>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_comments"><a href="/admin/delete/comment/<?= $elem['id'] ?>">Удалить комменатрий</a></div>