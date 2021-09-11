<?php
namespace App\Controllers;
use App\Models\UserManipulate;

class AdminDeleteUserController
{   
    public static function adminDeleteUser(int $user_id): void
    {
        (new UserManipulate)->deleteUser($user_id);

        header('Location: /');
    }
}