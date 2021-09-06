<?php
use App\Models\MySQLDB;

/*
  DB config
*/

define("DEFAULT_DB_CONNECTION", new MySQLDB());

/*
  Emails config
*/

define("SITE_EMAIL", "test-example-mail@kurlyk.su");
define("EMAIL_HEADERS", ['MIME-Version: ' => 1.0, 'Content-type: ' => 'text/html; charset=iso-8859-1',
                         'From' => SITE_EMAIL, 'Reply-To' => SITE_EMAIL]);
                         
define("EMAIL_REGISTRATION_MESSAGE_START", '<html>
<head>
  <title>Продолжите Вашу регистрацию</title>
</head>
<body>
  <p>Для завершения регистрации перейдите по этой ссылке: http://likeavito/registration/');

define("EMAIL_RESET_PASSWORD_MESSAGE_START", '<html>
<head>
  <title>Сброс пароля</title>
</head>
<body>
  <p>Для завершения регистрации перейдите по этой ссылке: http://likeavito/user/resetpassword/');

define("EMAIL_ACCOUNT_DELETE_MESSAGE_START", '<html>
<head>
  <title>Безвозвратное удаление Вашего аккаунта</title>
</head>
<body>
  <p>Для завершения регистрации перейдите по этой ссылке: http://likeavito/user/delete/');

define("EMAIL_CHANGE_EMAIL_MESSAGE_START", '<html>
<head>
  <title>Смена пароля</title>
</head>
<body>
  <p>Здравствуйте! С Вашего акакаунта на сайте http://likeavito/ поступил запрос на изменение Email. Если этот запрос делали не Вы,
  тогда просто проигнорируйте это письмо. Для подтверждения смены Email перейдите по ссылке: http://likeavito/user/change_email/');

define("EMAIL_CHANGE_PASSWORD_MESSAGE_START", '<html>
<head>
  <title>Смена пароля</title>
</head>
<body>
  <p>Здравствуйте! С Вашего акакаунта на сайте http://likeavito/ поступил запрос на изменение пароля. Если этот запрос делали не Вы,
  тогда просто проигнорируйте это письмо. Для подтверждения смены пароля перейдите по ссылке: http://likeavito/user/change_password/');

define("EMAIL_MESSAGE_END", '
</p>
</body>
</html>
');