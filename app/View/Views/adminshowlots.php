<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Автор</th>
            <th>Дата добавления</th>
        </tr>
        <?php foreach ($lots as $lot): ?>
        <tr>
            <td><?= $lot['id'] ?></td>
            <td><a href="/admin/change/lot/<?= $lot['id'] ?>"><?= $lot['title'] ?></a></td>
            <td><?= $lot['category'] ?></td>
            <td><a href="/admin/change/user/<?= $lot['owner_id'] ?>"><?= $lot['login'] ?></a></td>
            <td><?= $lot['add_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div>
    <?php if ($_GET['page'] != 1): ?><a href="/admin/lots?page=<?= ($_GET['page'] - 1)?>">Назад</a><?php endif; ?>
    <?php if ($_GET['page'] < $page_count): ?><a href="/admin/lots?page=<?= ($_GET['page'] + 1)?>">Вперед</a><?php endif; ?>
    </div>
</div>