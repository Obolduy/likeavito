<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Lots;
use App\Models\Comments;
use App\View\View;

class ShowUserController
{   
    public static function showUser(): void
    {
        $user = (new User)->getFullUserInfo($_SESSION['user']['id']);

        new View('showuser', ['user' => $user, 'title' => $user[0]['login']]);
    }

    public static function showUsersLots(): void
    {
        $lots = (new Lots)->getOne('lots', $_SESSION['user']['id'], 'owner_id');

        new View('showuserslots', ['lots' => $lots, 'title' => "Ваши товары"]);
    }

    public static function showUsersComments(): void
    {
        $comments = (new Comments)->getOne('comments', $_SESSION['user']['id'], 'user_id');

        new View('showuserscomments', ['comments' => $comments, 'title' => "Ваши комментарии"]);
    }

    public static function showOtherUser(int $user_id): void
    {
        $user = (new User)->getFullUserInfo($user_id);

        new View('showotheruser', ['user' => $user, 'title' => "Просмотр пользователя {$user[0]['login']}"]);
    }
}