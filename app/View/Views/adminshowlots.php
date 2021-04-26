<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Логин автора</th>
            <th>Дата добавления</th>
        </tr>
        <?php foreach($lots as $lot): ?>
        <tr>
            <td><?= $lot['id'] ?></td>
            <td><a href="/admin/change/lot/<?= $lot['id'] ?>"><?= $lot['title'] ?></a></td>
            <td><?= $lot['login'] ?></td>
            <td><?= $lot['add_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>