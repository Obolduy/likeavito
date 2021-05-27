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
            <a href="/deletecomment/<?= $comment['id'] ?>">Удалить</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>