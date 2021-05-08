<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminDeleteUserController
{   
    public static function adminDeleteUser(int $user_id): void
    {
        (new User)->deleteUser($user_id);

        header('Location: /');
    }
}