<?php

require 'C:\OpenServer\domains\likeavito\app\models\Authorization.php';

////////////////////////

class RegistrationController
{   
    public static function reg()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\registration.php';
        } else {
            return Authorization::registration();
        }
    }

    public static function logIn(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'login.php';
        }

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

    /**
	 * Checks login availability, login`s and password`s content 
	 * @param string login
     * @param string non-hashed password
     * @param string non-hashed confirmed password
	 * @return bool
	 */

    public static function registrationCheck(string $login, string $password, string $confirmPassword)
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        $base = new Base();

        if (!empty($login) and !empty($password)) {
            $emptyCheck = $base->getOne('users', $login, 'login');

            if (!empty($emptyCheck)) {
                echo 'Данный логин занят';
            } else {
                $emptyCheck = 1;
            }
            
            if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
                echo 'Пароль и логин могут содержать только латинские буквы и цифры';
            } else if (strlen($login) < 6 or strlen($login) > 32) {
                echo 'Логин должен состоять из 6-32 символов';
            } else if ($password != $confirmPassword) {
                echo 'Пароли не совпадают';
            } else {
                $correctCheck = 1;
            }
        }
        if ($emptyCheck == 1 and $correctCheck == 1) {
            return true;
        } else {
            return false;
        }
    }
}