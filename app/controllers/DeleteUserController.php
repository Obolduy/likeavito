<?php
namespace App\Controllers;

use App\Models\CommentManipulate;
use App\Models\EmailSender;
use App\Models\LotManipulate;
use App\Models\UserGet;
use App\Models\UserManipulate;

use App\View\View;

class DeleteUserController
{   
    public static function deleteRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('deleteuser', ['title' => 'Удалить пользователя']);
        } else {
            $user = (new UserGet)->getUser($_SESSION['user']['id']);

            if (password_verify($_POST['password'], $user['password'])) {
                (new EmailSender($user['email']))->sendDeleteMail(md5($user['email'] . time()));
            } else {
                echo 'Неправильный пароль!';
            }
        }
    }

    public static function deleteUser(string $token): void
    {
        if ($token == $_SESSION['deletelink']) {
            (new UserManipulate)->deleteUser($_SESSION['user']['id']);

            $userLots = (new LotManipulate)->deleteUserLots($_SESSION['user']['id']);

            $comment = new CommentManipulate();

            foreach ($userLots as $elem) {
                $comment->deleteLotComments($elem['id']);
            }

            $comment->deleteUserComments($_SESSION['user']['id']);

            $_SESSION['user']['id'] = null;
            $_SESSION['deletelink'] = null;
        }

        header('Location: /');
    }
}