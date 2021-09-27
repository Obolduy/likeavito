<?php
namespace App\Controllers;

use App\Models\PasswordReset;
use App\Models\PasswordValidation;
use App\View\View;

class ResetPasswordController
{   
    public static function resetRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('resetpassword', ['title' => 'Сброс пароля']);
        } else {
            $email = strip_tags($_POST['email']);
            $token = md5($email . time());

            $passwordReset = new PasswordReset($email);
            $passwordReset->passwordResetRequest($token);
            
            echo 'Запрос успешно отправлен!';
        }
    }

    public static function passwordResetForm(string $token): void
    {
        $passwordReset = new PasswordReset();
        $passwordReset->getEmailByToken($token);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($passwordReset->email) {
                new View('resetpasswordform', ['title' => 'Восстановление пароля']);
            } else {
                header('Location: /');
            }
        } else {
            $password = strip_tags($_POST['password']);
            $confirmPassword = strip_tags($_POST['confirmPassword']);

            $check = (new PasswordValidation)->checkPassword($password, $confirmPassword);

            if ($check) {
                $passwordReset->password = password_hash($password, PASSWORD_DEFAULT);
                $passwordReset->resetPassword($token);
                
                header('Location: /login');
            } else {
                $_SESSION['change_pass_err_msg'] = $check;

                header("Location: /user/resetpassword/$token");
            }
        }
    }
}