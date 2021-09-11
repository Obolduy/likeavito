<?php
namespace App\Controllers;

use App\Models\SendResetEmail;
use App\Models\User;
use App\View\View;

class ResetPasswordController
{   
    public static function resetRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('resetpassword', ['title' => 'Сброс пароля']);
        } else {
            $queue = new SendResetEmail();
            $queue->createQueue('send_reset_email');
            $queue->sendMessage(strip_tags($_POST['email']));
            $queue->closeConnection();
            
            echo 'Запрос успешно отправлен!';
        }
    }

    public static function passwordResetForm(string $token): void
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

            foreach ($password_reset as $elem) {
                $user->resetPassword($cryptPassword, $token, $elem['email']);
            }
            
            header('Location: /login');
        }
    }
}