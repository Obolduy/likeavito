<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminLoginController
{   
    public function adminLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('adminlogin');
        } else {
            $password = $_POST['password'];

            if ($password === 123) {
                $_SESSION['adminauth'] = true;
                
                header('Location: /admin'); die();  
            } else {
                echo 'Пароль неправильный!';
            }    
        }
    }
}