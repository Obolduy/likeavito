<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class ResetPasswordController
{   
    public function resetRequest($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('resetpassword');
        } else {
            $user = new User();

            $user->sendResetEmail($user_id);
            
            header('Location: index.php'); die();       
        }
    }

    public function passwordResetForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('resetpasswordform');
        } else {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if (!preg_match('#^[A-Za-z0-9]+$#', $password)) {
                echo 'Пароль может содержать только латинские буквы и цифры';
            } else if ($password != $confirmPassword) {
                echo 'Пароли не совпадают';
            }
            
            $cryptPassword = password_hash($password, PASSWORD_DEFAULT);

            $user = new User();

            $user->resetPassword($cryptPassword);
            
            header('Location: index.php'); die();       
        }
    }
}