<nav>
    <ul>
        <?php foreach($categories as $category): ?>
        <li><a href="/category/<?= $category['id'] ?>/"><?= $category['category'] ?></a></li>
        <?php endforeach ?>

    </ul>
</nav>
<div class="main">
Последние 5 объявлений:
<?php foreach($lots as $lot): ?>
    <div>
        <a href="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>"><?= $lot['title'] ?></a>
    </div>
<?php endforeach; ?>
</div>