<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class ResetPasswordController
{   
    public function resetRequest(int $user_id): void//
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('resetpassword', ['title' => 'Сброс пароля']);
        } else {
            $user = new User();

            $user->sendResetEmail(strip_tags($_POST['email']));
            
            echo 'Запрос успешно отправлен!';
        }
    }

    public function passwordResetForm(string $token): void
    {
        $user = new User();
        $password_reset = $user->getOne('password_reset', $token, 'token');

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($password_reset) {
                new View('resetpasswordform', ['title' => 'Восстановление пароля']);
            } else {
                header('Location: /');
            }
        } else {
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);

            if (!preg_match('#^[A-Za-z0-9]+$#', $password)) {
                echo 'Пароль может содержать только латинские буквы и цифры';
            } else if ($password != $confirmPassword) {
                echo 'Пароли не совпадают';
            }
            
            $cryptPassword = password_hash($password, PASSWORD_DEFAULT);

            $user->resetPassword($cryptPassword, $token, $password_reset['email']);
            
            header('Location: /login');
        }
    }
}