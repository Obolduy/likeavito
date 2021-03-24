<?php

require_once 'classes.php';

class Authorization implements IAuth
{   
    public static function registration(): void
    {
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);
        $confirmPassword = strip_tags($_POST['confirmPassword']);
        $name = strip_tags($_POST['name']);
        $city_id = $_POST['city_id'];

        $check = self::registrationCheck($login, $password, $confirmPassword);

        if ($check == true) {
            session_start();
            $_SESSION['userauth'] = true;

            $base = new Base();

            $cryptpassword = password_hash($password, PASSWORD_DEFAULT);
            
            $base->addUser($login, $cryptpassword, $name, $city_id);

            $user_id = $base->getOne('users', $name, 'name');

            $_SESSION['user_id'] = $user_id['id'];
            $_SESSION['user_login'] = $login;

            header('Location: index.php'); die();       
        }
    }

    public static function logIn(): void
    {
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);

        $check = self::authCheck($login, $password);

        if ($check == true) {
            session_start();
            $_SESSION['userauth'] = true;

            $base = new Base();

            $user = $base->getOne('users', $login, 'login');
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $login;
            
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
            $checkpassword = password_verify($this->base->password, $siteUser['password']);
            $this->base->query = "SELECT * FROM users WHERE login='$login'";
            $this->base->result = mysqli_query($this->base->link, $this->base->query) or die(mysqli_error($this->base->link));
            $result = mysqli_fetch_assoc($this->base->result);

            $checkpassword = password_verify($password, $result['password']);

            if (!empty($this->base->result) and $checkpassword == true) {
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

    protected static function registrationCheck(string $login, string $password, string $confirmPassword): bool
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
        }
    }
}