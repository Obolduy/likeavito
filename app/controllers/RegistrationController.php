<?php

require 'C:\OpenServer\domains\likeavito\app\models\Base.php';
require 'C:\OpenServer\domains\likeavito\app\models\User.php';

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\registration.php';
        } else {
            $login = strip_tags($_POST['login']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);
            $name = strip_tags($_POST['name']);
            $surname = strip_tags($_POST['surname']);
            $city_id = $_POST['city_id'];

            $check = self::registrationCheck($login, $password, $confirmPassword);

            if ($check == true) {
                session_start();
                $_SESSION['userauth'] = true;

                $base = new Base();

                $cryptpassword = password_hash($password, PASSWORD_DEFAULT);
                
                $base->addUser($login, $cryptpassword, $email, $city_id);

                $user_info = $base->getOne('users', $email, 'email');

                foreach($user_info as $elem) {
                    $base->addUserInfo($name, $surname, $elem['id']);

                    $user = new User($elem['id']);
                    
                    $_SESSION['user'] = $user->data;
                }

                header('Location: index.php'); die();       
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