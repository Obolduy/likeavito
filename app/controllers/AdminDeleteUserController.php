<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminDeleteUserController
{   
    public static function adminDeleteUser(int $user_id): void
    {
        $user = new User;

        $user->delete('users', $user_id);

        $user_lots = $user->getOne('lots', $user_id, 'owner_id');

        foreach($user_lots as $elem) {
            $user->delete('lots_pictures', $elem['id'], 'lot_id');
        }

        $user->delete('lots', $user_id, 'owner_id');

        if (is_dir("/img/users/$user_id")) {
            rmdir("/img/users/$user_id");
        }

        header('Location: /');
    }
}