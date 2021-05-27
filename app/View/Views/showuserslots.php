<div>
    <table>
        <tr>
            <th>Название</th>
            <th>Дата добавления</th>
            <th>Редактирование</th>
        </tr>
        <?php foreach($lots as $lot): ?>
        <tr>
            <td><a href="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>"><?= $lot['title'] ?></a></td>
            <td><?= $lot['add_time'] ?></td>
            <td><a href="/managelot/<?= $lot['id'] ?>/change">Редактировать</a><br>
            <a href="/managelot/<?= $lot['id'] ?>/delete">Удалить</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>