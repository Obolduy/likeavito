<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Логин</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Забанен</th>
            <th>Дата регистрации</th>
        </tr>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><a href="/admin/change/user/<?= $user['id'] ?>"><?= $user['login'] ?></a></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['surname'] ?></td>
            <td><?php if ($user['ban_status'] === 1) {echo 'Да';} else {echo 'Нет';} ?></td>
            <td><?= $user['registration_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>