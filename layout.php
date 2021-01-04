<?php
require_once 'classes.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title><?= $pageTitle ?></title>
        <style type="text/css">
            body {
                padding: 5;
            }
            .loged {

            }
            .login {
                margin-left: 8;
            }
            .logout {
                display: flex;
                flex-direction: row;
                margin-bottom: -37;
                margin-top: 3;
                justify-content: right;
                margin-right: 100;
            }
            .else {

            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <?php include 'header.php' ?>
            </header>
            <main>
                <?= $content ?>
            </main>
            <footer>
                <?php include 'footer.php' ?>
            </footer>
        </div>
    </body>
</html>