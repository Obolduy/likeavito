<?php
namespace App\Controllers;
use App\Models\User;

class LoginController
{   
    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\login.php';
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
                
                header('Location: index.php'); die();
            }
        }
    }
}