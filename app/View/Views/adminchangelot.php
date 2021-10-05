<?php
if ($_SESSION['lot_err_msg']) {
    foreach ($_SESSION['lot_err_msg'] as $elem) {
        echo $elem;   
    }

    unset($_SESSION['lot_err_msg']);
}
?>
<form enctype="multipart/form-data" method="POST">
    <div>Введите название: <input type="text" name="title" value="<?= $lot['title'] ?>" required></div>
    <div>Введите цену: <input type="text" name="price" value="<?= $lot['price'] ?>" required></div>
    <div>Введите описание: <textarea name="description"><?= $lot['description'] ?></textarea></div>
    <div><select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>" <?php if ($lot['category_id'] == $category['id']) {echo 'selected';} ?>><?= $category['category']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div>Загрузите картинки (Необязательно): <input type="file" accept="image/*" name="photos[]" multiple></div>
    <?php if ($pictures): ?>
    <div><input name="photos_radio" type="radio" value="photos_add"> Добавить фото к существующим</div>
    <div><input name="photos_radio" type="radio" value="photos_new"> Заменить фото</div>
    <?php endif; ?>
    <div><input type="checkbox" name="display" value="1" <?php if ($lot['display'] == 1) echo 'checked'; ?>> Отображать лот</div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_del_link"><a onclick="confirmDeleteLot()" href="/admin/delete/lot/<?= $lot['id'] ?>">Удалить лот</a></div>
<script type="text/javascript">
    function confirmDeleteLot() {
        if (confirm("Вы уверены, что хотите удалить товар <?php echo $lot['title']; ?>?")) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>