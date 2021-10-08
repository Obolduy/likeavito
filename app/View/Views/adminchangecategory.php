<form method="POST">
    <div>Введите название: <input type="text" name="category" value="<?= $category['category'] ?>" required></div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_del_link"><a onclick="confirmDeleteCategory()" href="/admin/delete/category/<?= $category['id'] ?>">Удалить категорию</a></div>
<script type="text/javascript">
    function confirmDeleteCategory() {
        if (confirm("Вы уверены, что хотите удалить категорию?")) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>