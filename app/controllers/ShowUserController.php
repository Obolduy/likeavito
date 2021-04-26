<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class ShowUserController
{   
    public static function showUser(): void
    {
        $user = (new User)->getFullUserInfo($_SESSION['user']['id']);

        new View('showuser', ['user' => $user]);
    }

    public static function showOtherUser(int $user_id): void
    {
        $user = (new User)->getFullUserInfo($user_id);

        new View('showotheruser', ['user' => $user]);
    }
}