<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Текст</th>
            <th>Логин автора</th>
            <th>Название лота</th>
            <th>Дата добавления</th>
        </tr>
        <?php foreach($comments as $comment): ?>
        <tr>
            <td><?= $comment['id'] ?></td>
            <td><a href="/admin/change/comment/<?= $comment['id'] ?>"><?= $comment['description'] ?></a></td>
            <td><a href="/admin/change/user/<?= $comment['user_id'] ?>"><?= $comment['login'] ?></a></td>
            <td><a href="/admin/change/lot/<?= $comment['lot_id'] ?>"><?= $comment['title'] ?></a></td>
            <td><?= $comment['add_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div>
    <?php if ($_GET['page'] != 1): ?><a href="/admin/comments?page=<?= ($_GET['page'] - 1)?>">Назад</a><?php endif; ?>
    <?php if ($_GET['page'] < $page_count): ?><a href="/admin/comments?page=<?= ($_GET['page'] + 1)?>">Вперед</a><?php endif; ?>
    </div>
</div>