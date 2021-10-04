<?php
namespace App\Controllers;

use App\Models\UserGet;
use App\Models\LotGet;
use App\Models\CommentGet;
use App\View\View;

class ShowUserController
{   
    public static function showUser(): void
    {
        new View('showuser', ['user' => (new UserGet)->getUser($_SESSION['user']['id']), 'title' => $_SESSION['user']['login']]);
    }

    public static function showUsersLots(): void
    {
        $lots = (new LotGet)->getUserLots($_SESSION['user']['id']);

        new View('showuserslots', ['lots' => $lots, 'title' => "Ваши товары"]);
    }

    public static function showUsersComments(): void
    {
        $comments = (new CommentGet)->getCommentsByUserId($_SESSION['user']['id']);

        new View('showuserscomments', ['comments' => $comments, 'title' => "Ваши комментарии"]);
    }

    public static function showOtherUser(int $user_id): void
    {
        if ($user_id == $_SESSION['user']['id']) {
            header('Location: /user'); die();
        }

        $user = (new UserGet)->getOtherUser($user_id);

        new View('showotheruser', ['user' => $user, 'title' => "Просмотр пользователя {$user['login']}"]);
    }
}