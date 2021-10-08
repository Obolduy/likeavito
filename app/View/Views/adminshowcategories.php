<div class="admin_categories"><a href="/admin/add/category">Добавить категорию</a></div>
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