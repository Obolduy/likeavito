<?php
namespace App\Controllers;

use App\Models\SendResetEmail;
use App\Models\PasswordChange;
use App\Models\PasswordValidation;
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
        $password_reset = new PasswordChange();
        $password_reset->getEmailByToken($token);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($password_reset->email) {
                new View('resetpasswordform', ['title' => 'Восстановление пароля']);
            } else {
                header('Location: /');
            }
        } else {
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);

            $check = (new PasswordValidation)->checkPassword($password, $confirmPassword);

            if ($check) {
                $password_reset->password = password_hash($password, PASSWORD_DEFAULT);
                $password_reset->resetPassword($token);
                
                header('Location: /login');
            } else {
                $_SESSION['change_pass_err_msg'] = $check;

                header("Location: /user/resetpassword/$token");
            }
        }
    }
}