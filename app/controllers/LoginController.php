<?php
namespace App\Controllers;

use App\Models\UserLogin;
use App\Models\UserGet;
use App\Models\UserValidation;
use App\View\View;

class LoginController
{   
    public static function login(): void
    {
        if (!$_SESSION['http_referer']) {
            $_SESSION['http_referer'] = $_SERVER['HTTP_REFERER'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('login', ['title' => 'Вход на сайт']);
        } else {
            $login = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);

            $check = (new UserValidation)->authCheck($login, $password);

            if ($check === true) {
                $userLogin = new UserLogin($login);
                $_SESSION['user'] = $userLogin->login($_POST['remember_me']);

                $_SESSION['userauth'] = true;

                header("Location:" . $_SESSION['http_referer']);
                unset($_SESSION['http_referer']);
            } else {
                $_SESSION['login_err_msg'] = $check;

                header('Location: /login');
            }
        }
    }

    public static function loginByRememberToken(string $rememberToken): void
    {
        $user = (new UserGet)->getUserByToken($rememberToken);
    
        $_SESSION['user'] = ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email']];
        $_SESSION['userauth'] = true;
    }

    public static function logout(): void
    {
        session_destroy();
        setcookie('remember_token', '', time());

        header('Location: /');
    }
}