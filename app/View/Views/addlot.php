<?php
if ($_SESSION['addlot_err_msg']) {
    foreach ($_SESSION['addlot_err_msg'] as $elem) {
        echo $elem . '<br>';
    }
    unset($_SESSION['addlot_err_msg']);
}
?>
<form method="POST" enctype="multipart/form-data">
    <div>Введите название: <input type="text" name="title" required></div>
    <div>Введите цену: <input type="text" name="price" required></div>
    <div>Введите описание: <textarea name="description" required></textarea></div>
    <div><select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>"><?= $category['category']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div class="photos">Добавьте изображение: <input type="file" accept="image/*" name="photos[]" multiple></div>
    <div><input type="submit" name="submit"></div>
</form>