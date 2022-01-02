Объявления:

<div>
<table id="table">
        <tr>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=title">Название</a></th>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=price">Цена</a></th>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=city">Город</a></th>
            <th><a href="/category/<?= $lots[0]['category_id'] ?>&sort=add_time">Дата добавления</a></th>
        </tr>
        <?php foreach ($lots as $lot): ?>
        <tr id="table__rows">
            <td>
                <?php if ($lots_pictures['lot_id'] == $lot['id']): ?>
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/img/lots/<?= $lot['id'] ?>/<?= $lots_pictures['picture'] ?>" target="_blank"><img height=30% width=20% src="http://<?= $_SERVER['SERVER_NAME'] ?>/img/lots/<?= $lots_pictures['lot_id'] ?>/<?= $lots_pictures['picture'] ?>" alt="Картинки"></a><br>
                <?php endif; ?>
                <a href="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>" target="_blank"><?= $lot['title'] ?></a>
            </td>
            <td><?= $lot['price'] ?>₽</td>
            <td><?= $lot['city'] ?></td>
            <td><?= $lot['add_time'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<div>
    <?php if ($_GET['page'] != 1): ?><a href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] - 1)?>&<?php if($_GET['sort']) echo "sort={$_GET['sort']}" ?>">Назад</a><?php endif; ?>
    <?php if ($_GET['page'] < $page_lot_count): ?><a id="pagination__next" href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] + 1)?>&<?php if($_GET['sort']) echo "sort={$_GET['sort']}" ?>">Вперед</a>
    <a id="pagination__more" href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] + 1)?>&<?php if($_GET['sort']) echo "sort={$_GET['sort']}" ?>">Прогрузить еще</a>    
    <?php endif; ?>
</div>
<script src="/js/ajaxcategoryshowing.js"></script>