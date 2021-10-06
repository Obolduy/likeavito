<?php
namespace App\Controllers;

use App\View\View;

class AdminLoginController
{   
    public static function adminLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('adminlogin', ['title' => 'Вход в панель администратора']);
        } else {
            if (strip_tags($_POST['password']) == 123) {
                $_SESSION['adminauth'] = true;
                
                header('Location: /admin');  
            } else {
                $_SESSION['admin_err_msg'] = 'Пароль неправильный!';

                header('Location: /admin/login');
            }    
        }
    }
}