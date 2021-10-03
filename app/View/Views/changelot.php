<?php
if ($_SESSION['lot_err_msg']) {
    echo $_SESSION['lot_err_msg'];

    unset($_SESSION['lot_err_msg']);
}
?>
<form enctype="multipart/form-data" method="POST">
    <?php foreach ($lot as $elem): ?>
    <div>Введите название: <input type="text" name="title" value="<?= $elem['title'] ?>" required></div>
    <div>Введите цену: <input type="text" name="price" value="<?= $elem['price'] ?>" required></div>
    <div>Введите описание: <textarea name="description"><?= $elem['description'] ?></textarea></div>
    <div><select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>" <?php if ($elem['category_id'] == $category['id']) {echo 'selected';} ?>><?= $category['category']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <?php endforeach; ?>
    <div>Загрузите картинки (Необязательно): <input type="file" accept="image/*" name="photos[]" multiple></div>
    <div><input type="checkbox" name="display" value="1"> Отображать лот</div>
    <div><input type="submit" name="submit"></div>
</form>