<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminLoginController
{   
    public static function adminLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('adminlogin');
        } else {
            if (strip_tags($_POST['password']) === 123) {
                $_SESSION['adminauth'] = true;
                
                header('Location: /admin');  
            } else {
                echo 'Пароль неправильный!';
            }    
        }
    }
}