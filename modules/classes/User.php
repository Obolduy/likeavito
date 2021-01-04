<?php

require_once 'classes.php';

class User implements UserInterface
{
    protected $base;
    public $login;
    public $password;
    public $name;
    public $id;

    public function __construct()
    {
        $this->base = new Base('localhost', 'root', 'root', 'test');
    }
    
    public function registration()
    {
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);
        $confirmPassword = strip_tags($_POST['confirmPassword']);
        $name = strip_tags($_POST['name']);
        $city_id = $_POST['city_id'];

        $check = $this->registrationCheck($login, $password, $confirmPassword);

        if ($check == true) {
            session_start();
            $_SESSION['userauth'] = true;
            $cryptpassword = password_hash($password, PASSWORD_DEFAULT);
            
            $this->base->addUser($login, $cryptpassword, $name, $city_id);
            $user_id = $this->base->getOne('users', $name, 'name');
            $_SESSION['user_id'] = $user_id['id'];

            $this->login = $login;
            $this->password = $password;
            $this->name = $name;

            $_SESSION['user_login'] = $login;

            header('Location: index.php'); die();       
        }
    }

    public function logIn()
    {
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);

        $check = $this->authCheck($login, $password);

        if ($check == true) {
            session_start();
            $_SESSION['userauth'] = true;

            $user = $this->base->getOne('users', $login, 'login');
            $_SESSION['user_id'] = $user['id'];

            $this->login = $login;
            $this->password = $password;
            $this->name = $name;

            $_SESSION['user_login'] = $login;
            
            header('Location: index.php'); die();
        }
    }

    public function getUserTable($user_id)
    {
        $user = $this->base->getOne('users', $user_id);

        $content = "<br><form method=POST>
        Имя и фамилия: <input type=\"text\" name=\"name\" value=\"{$user['name']}\"><br><br>
        Логин: <input type=\"text\" name=\"login\" value=\"{$user['login']}\"><br><br>
        Пароль: <input type=\"password\" name=\"password\" value=\"\"><br><br>
        Подтвердите пароль: <input type=\"text\" name=\"confirmpassword\" value=\"\"><br><br>
        <input type=\"submit\" name=\"submit\">
        </form>";

        return $content;
    }

    public function changeInformation($name, $login, $password, $user_id)
    {
        $this->base->query = "UPDATE users SET name='$name', password='$password', login='$login' WHERE id=$user_id";
        $this->base->result = mysqli_query($this->base->link, $this->base->query);

        return 'Информация успешно изменена';
    }

    public function changeLogin()
    {

    }

    public function changeCheck($login, $password, $confirmPassword, $current_login)
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        if (!empty($login) and !empty($password)) {
            $emptyCheck = $this->base->getOne('users', $login, 'login');

            if (!empty($emptyCheck) AND $emptyCheck['login'] != $current_login) {
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

    protected function authCheck($login, $password)
    {
        $check = $this->base->getOne('users', $login, 'login');
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

    protected function registrationCheck($login, $password, $confirmPassword)
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        if (!empty($login) and !empty($password)) {
            $emptyCheck = $this->base->getOne('users', $login, 'login');

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
