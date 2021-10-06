<?php 
if ($_SESSION['main_err_msg']) {
    foreach ($_SESSION['main_err_msg'] as $elem) {
        echo $elem . '<br>';
    }
    unset($_SESSION['main_err_msg']);
}
?>
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