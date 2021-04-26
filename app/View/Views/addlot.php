<form method="POST">
    <div>Введите название: <input type="text" name="title" required></div>
    <div>Введите цену: <input type="text" name="price" required></div>
    <div>Введите описание: <textarea name="description"></textarea></div>
    <div><select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>"><?= $category['category']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div><input type="submit" name="submit"></div>
</form>