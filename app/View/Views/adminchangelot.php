<form method="POST">
    <?php foreach($info as $elem): ?>
    <div>Введите название: <input type="text" name="title" value="<?= $elem['title'] ?>" required></div>
    <div>Введите цену: <input type="text" name="price" value="<?= $elem['price'] ?>" required></div>
    <div>Введите описание: <textarea name="description"><?= $elem['description'] ?></textarea></div>
    <div><select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>" <?php if ($elem['category_id'] == $category['id']) {echo 'selected';} ?>><?= $category['category']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <?php endforeach; ?>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_comments"><a href="/admin/delete/lot/<?= $elem['id'] ?>">Удалить лот</a></div>