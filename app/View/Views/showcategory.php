Объявления:

<?php foreach($lots as $lot): ?>
<div>
    <a href="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>"><?= $lot['title'] ?></a>
</div>
<?php endforeach; ?>
<div>
    <?php if ($_GET['page'] != 1): ?><a href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] - 1)?>">Назад</a><? endif; ?>
    <?php if ($_GET['page'] < $str_count): ?><a href="/category/<?= $lot['category_id'] ?>?page=<?= ($_GET['page'] + 1)?>">Вперед</a><? endif; ?>
</div>