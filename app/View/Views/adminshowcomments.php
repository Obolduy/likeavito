<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Название лота</th>
            <th>Текст</th>
            <th>Логин автора</th>
            <th>Дата добавления</th>
        </tr>
        <?php foreach($comments as $comment): ?>
        <tr>
            <td><?= $comment['id'] ?></td>
            <td><a href="/admin/change/comment/<?= $comment['id'] ?>"><?= $comment['title'] ?></a></td>
            <td><?= $comment['description'] ?></td>
            <td><?= $comment['login'] ?></td>
            <td><?= $comment['add_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>