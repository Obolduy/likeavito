<?php
namespace App\Controllers;

use App\Models\UserAuth;
use App\Models\LotGet;
use App\Models\CommentGet;
use App\Models\UserGet;
use App\View\View;

class ShowUserController
{   
    public static function showUser(): void
    {
        new View('showuser', ['user' => (new UserAuth)->data, 'title' => (new UserAuth)->data['login']]);
    }

    public static function showUsersLots(): void
    {
        $lots = (new LotGet)->getUserLots($_SESSION['user_id']);

        new View('showuserslots', ['lots' => $lots, 'title' => "Ваши товары"]);
    }

    public static function showUsersComments(): void
    {
        $comments = (new CommentGet)->getCommentsByUserId($_SESSION['user_id']);

        new View('showuserscomments', ['comments' => $comments, 'title' => "Ваши комментарии"]);
    }

    public static function showOtherUser(int $user_id): void
    {
        $user = (new UserGet)->getOtherUser($user_id);

        new View('showotheruser', ['user' => $user, 'title' => "Просмотр пользователя {$user['login']}"]);
    }
}