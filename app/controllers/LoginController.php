<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class LoginController
{   
    public static function login(): void
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('login', ['title' => 'Вход на сайт']);
        } else {
            $login = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);

            $check = $user->authCheck($login, $password);

            if ($check === true) {
                $_SESSION['userauth'] = true;
                $user_info = $user->getOne('users', $login, 'login');

                foreach ($user_info as $elem) {
                    $user->setData($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
                
                if ($_POST['remember_me'] == 1) {
                    $user->setRememberToken($user->data['id']);
                }
                
                header('Location: /');
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