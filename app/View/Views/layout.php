<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title><?php echo $title ? $title : 'Почти Авито, только совсем не Авито'; ?></title>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <div class="main__title"><a href="/">Главная страница</a></div>
                <?php if ($_SESSION['userauth']): ?>
                <div class="user"><a href="/user"><?= $_SESSION['user']['login'] ?></a></div>
                <div class="logout"><a href="/logout">Выйти</a></div>
                <div class="addlot__link"><a href="/addlot">Добавить лот</a></div>
                <?php else: ?>
                <div class="login"><a href="/login">Войти</a></div>
                <div class="registration"><a href="/registration">Зарегистрироваться</a></div>
                <?php endif; ?>
            </header>
            <main>
                <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/App/View/Views/$view.php"; ?>
            </main>
            <footer>
                <div><a href="http://github.com/Obolduy">Абалдуй</a></div>
            </footer>
        </div>
    </body>
</html>
<script src="/js/linkchecker.js"></script>