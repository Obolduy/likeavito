<form method="POST">
    <div>Введите название: <input type="text" name="city" value="<?= $city['city'] ?>" required></div>
    <div><input type="submit" name="submit"></div>
</form>
<div class="admin_del_link"><a onclick="confirmDeleteCity()" href="/admin/delete/city/<?= $city['id'] ?>">Удалить город</a></div>
<script type="text/javascript">
    function confirmDeleteCity() {
        if (confirm("Вы уверены, что хотите удалить город?")) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>