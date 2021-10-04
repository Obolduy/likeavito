<div>
    <table>
        <tr>
            <th>Текст</th>
            <th>Дата добавления</th>
            <th>Редактирование</th>
        </tr>
        <?php foreach($comments as $comment): ?>
        <tr>
            <td><?= $comment['description'] ?></td>
            <td><?= $comment['add_time'] ?></td>
            <td><a href="/changecomment/<?= $comment['id'] ?>">Редактировать</a><br>
            <a onclick="confirmDeleteComment()" href="/deletecomment/<?= $comment['id'] ?>">Удалить</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<script type="text/javascript">
    function confirmDeleteComment() {
        if (confirm("Вы уверены, что хотите удалить комментарий?")) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>