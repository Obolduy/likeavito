<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
        </tr>
        <?php foreach($categories as $category): ?>
        <tr>
            <td><?= $category['id'] ?></td>
            <td><a href="/admin/change/category/<?= $category['id'] ?>"><?= $category['category'] ?></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>