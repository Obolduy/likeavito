<nav>
    <ul>
        <?php foreach ($categories as $category): ?>
        <li><?= $category ?></li>
        <?php endforeach ?>

    </ul>
</nav>
<div class="main">
Последние 5 объявлений:
<?php foreach ($lots as $lot): ?>
    <div>
        <?= $lot ?>
    </div>
<?php endforeach; ?>
</div>