<?php foreach($lots as $lot): ?>
    <div>
        <a href="/category/<?= $lot['category_id'] ?>/<?= $lot['id'] ?>"><?= $lot['title'] ?></a>
    </div>
<?php endforeach; ?>