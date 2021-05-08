<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class DeleteLotController
{   
    public static function deleteRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('deleteuser', ['title' => 'Удалить пользователя']);
        } else {
            if (password_verify($_POST['password'], $_SESSION['user']['password'])) {
                $user = new User();
                
                $user->sendDeleteMail($_SESSION['user']['email']);
            } else {
                echo 'Неправильный пароль!';
            }
        }
    }

    public static function deleteUser(string $token): void
    {
        if ($token == $_SESSION['deletelink']) {
            (new User)->deleteUser($user_id);

            $_SESSION['user'] = null;
            $_SESSION['deletelink'] = null;
        }

        header('Location: /');
    }
}