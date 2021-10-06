<?php
namespace App\Controllers;

use App\Models\LotManipulate;
use App\Models\CommentManipulate;
use App\Models\UserManipulate;

class AdminDeleteUserController
{   
    public static function adminDeleteUser(int $user_id): void
    {
        (new UserManipulate)->deleteUser($user_id);
        
        $userLots = (new LotManipulate)->deleteUserLots($user_id);

        $comment = new CommentManipulate();

        foreach ($userLots as $elem) {
            $comment->deleteLotComments($elem['id']);
        }

        $comment->deleteUserComments($user_id);

        $_SESSION['admin_user_status'] = 'Пользователь успешно удален!';

        header('Location: /admin/users');
    }
}