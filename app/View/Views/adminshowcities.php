<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
        </tr>
        <?php foreach($cities as $city): ?>
        <tr>
            <td><?= $city['id'] ?></td>
            <td><a href="/admin/change/city/<?= $city['id'] ?>"><?= $city['city'] ?></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>