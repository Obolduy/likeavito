<form method="POST">
    <div>Введите описание: <textarea name="description"><?= $comment['description'] ?></textarea></div>
    <div><input type="checkbox" name="display" value="1" <?php if ($comment['display'] == 1) echo 'checked'; ?>>Отображать комментарий</div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_del_link"><a onclick="confirmDeleteComment()" href="/admin/delete/comment/<?= $comment['id'] ?>">Удалить комменатрий</a></div>
<script type="text/javascript">
    function confirmDeleteComment() {
        if (confirm("Вы уверены, что хотите удалить комментарий?")) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>