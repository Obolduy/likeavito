<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class LoginController
{   
    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            (new View('login'));
        } else {
            $login = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);

            $check = User::authCheck($login, $password);

            if ($check == true) {
                session_start();
                $_SESSION['userauth'] = true;

                $user = new User();

                $user_info = $base->getOne('users', $login, 'login');

                foreach($user_info as $elem) {
                    $user->setData($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
                
                if ($_POST['remember_me'] === 1) {
                    $user->setRememberToken($user->data['id']);
                }
                
                header('Location: index.php'); die();
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