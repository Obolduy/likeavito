<?php
if ($_SESSION['reg_err_msg']) {
    foreach ($_SESSION['reg_err_msg'] as $elem) {
        echo $elem . '<br>';
    }
    unset($_SESSION['reg_err_msg']);
}
?>
<form enctype="multipart/form-data" method="POST" id="registration__form">
    <div>Введите логин: <input type="text" id="registration__login" name="login" required></div>
    <div>Введите email: <input type="text" id="registration__email" name="email" required></div>
    <div>Введите Ваше имя: <input type="text" name="name" required></div>
    <div>Введите Вашу фамилию: <input type="text" name="surname" required></div>
    <div>Введите пароль: <input type="password" id="registration__password" name="password" required></div>
    <div>Подтвердите пароль: <input type="password" id="registration__confirmPassword" name="confirmPassword" required></div>
    <div>Загрузите Ваш аватар (Необязательно): <input type="file" accept="image/*" name="photo"></div>
    <div>Выберите Ваш город: <select name="city_id">
        <?php foreach($cities as $city): ?>
        <option value="<?= $city['id'] ?>"><?= $city['city']; ?></option>
        <?php endforeach; ?>
    </select></div>
    <div><input type="submit" name="submit" id="registration__submit" value="Зарегистрироваться"></div>
</form>
<script src="/js/registrationchecker.js"></script>