<?php
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

define("EMAIL_MESSAGE_END", '
</p>
</body>
</html>
');