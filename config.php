<?php
define("SITE_EMAIL", "test-example-mail@kurlyk.su");
define("EMAIL_HEADERS", ['MIME-Version: ' => 1.0, 'Content-type: ' => 'text/html; charset=iso-8859-1',
                         'From' => SITE_EMAIL, 'Reply-To' => SITE_EMAIL]);
define("EMAIL_MESSAGE_START", '<html>
<head>
  <title>Тайтл для Письма</title>
</head>
<body>
  <p>Для завершения регистрации перейдите по этой ссылке: http://likeavito/registration/');
define("EMAIL_MESSAGE_END", '
</p>
</body>
</html>
');