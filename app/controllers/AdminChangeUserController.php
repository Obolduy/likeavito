<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminChangeUserController
{  
    public static function adminShowUsersTable(): void
    {
        $users = (new User)->getFullUserInfo();

        new View('adminshowusers', ['users' => $users, 'title' => 'Просмотр пользователей']);
    }

    public static function adminChangeUser(int $user_id): void
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = $user->getAll('cities');
            $user = $user->getFullUserInfo($user_id);

            new View('adminchangeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменение пользователя']);
        } else {           
            $data = [strip_tags($_POST['login']), strip_tags($_POST['email']), $_POST['city_id'], $_POST['ban_status'], $user_id];

            $user->update("UPDATE users SET login = ?, email = ?, city_id = ?, ban_status = ?, updated_at = now() WHERE id = ?", $data);
            $user->update("UPDATE names SET name = ? WHERE user_id = ?", [strip_tags($_POST['name']), $user_id]);
            $user->update("UPDATE surnames SET surname = ? WHERE user_id = ?", [strip_tags($_POST['surname']), $user_id]);
        }
    }
}