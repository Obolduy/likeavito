<?php
namespace App\Controllers;
use App\Models\UserManipulate;

class AdminDeleteUserController
{   
    public static function adminDeleteUser(int $user_id): void
    {
        if ((new UserManipulate)->deleteUser($user_id)) {
            $_SESSION['admin_user_status'] = 'Пользователь успешно удален!';
        }

        header('Location: /admin/users');
    }
}