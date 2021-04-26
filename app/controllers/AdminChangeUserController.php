<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminChangeUserController
{  
    public function adminShowUsersTable(): void
    {
        $users = (new User)->getFullUserInfo();

        new View('adminshowusers', ['users' => $users]);
    }

    public function adminChangeUser(int $user_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = (new User)->getFullUserInfo($user_id);

            new View('adminchangeuser');
        } else {
            $password = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
            
            $data = [strip_tags($_POST['login']), $password, strip_tags($_POST['email']),
                $_POST['email'], $_POST['ban_status'], $user_id];
    
            $user = new User();

            $user->update("UPDATE users SET login = ?, password = ?, email = ?, city_id, ban_status, updated_at = now()
                WHERE id = ?", $data);
            $user->update("UPDATE names SET name = ? WHERE user_id = ?", [strip_tags($name), $user_id]);
            $user->update("UPDATE surnames SET surname = ? WHERE user_id = ?", [strip_tags($surname), $user_id]);
        }
    }
}