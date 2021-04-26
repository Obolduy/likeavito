<form method="POST">
    <?php foreach($lot as $elem): ?>
    <div>Введите название: <input type="text" name="title" value="<?= $elem['title'] ?>" required></div>
    <div>Введите цену: <input type="text" name="price" value="<?= $elem['price'] ?>" required></div>
    <div>Введите описание: <textarea name="description"><?= $elem['description'] ?></textarea></div>
    <?php endforeach; ?>
    <div><input type="submit" name="submit"></div>
</form>