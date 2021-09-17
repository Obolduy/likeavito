<?php
namespace App\Controllers;

use App\Models\UserLogin;
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
                $login = new UserLogin($login);
                $login->login($_POST['remember_me']);

                header("Location:" . $_SESSION['http_referer']);
                
                unset($_SESSION['http_referer']);
            } else {
                $_SESSION['login_err_msg'] = $check;

                header('Location: /login');
            }
        }
    }

    public static function logout(): void
    {
        session_destroy();
        setcookie('remember_token', '', time());

        header('Location: /');
    }
}