<?php
require 'C:\OpenServer\domains\likeavito\app\models\Base.php';
require 'C:\OpenServer\domains\likeavito\app\models\User.php';

class LoginController
{   
    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\login.php';
        } else {
            $login = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);

            $check = self::authCheck($login, $password);

            if ($check == true) {
                session_start();
                $_SESSION['userauth'] = true;

                $base = new Base();

                $user_info = $base->getOne('users', $login, 'login');

                foreach($user_info as $elem) {
                    $user = new User($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
                
                header('Location: index.php'); die();
            }
        }
    }

    /**
	 * Validate login and password
	 * @param string login
     * @param string non-hashed password
	 * @return bool
	 */

    protected static function authCheck(string $login, string $password): bool
    {
        $base = new Base();

        $check = $base->getOne('users', $login, 'login');

        if (!empty($check)) {
            $user = $base->selectQuery("SELECT * FROM users WHERE login = '$login'");

            foreach($user as $elem) {
                $checkpassword = password_verify($password, $elem['password']);
            }

            if (!empty($user) and $checkpassword == true) {
                return true;
            } else {
                echo 'Неправильный логин или пароль';
            }
        }
    }
}