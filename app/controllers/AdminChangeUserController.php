<?php
namespace App\Controllers;

use App\Models\UserGet;
use App\Models\UserValidation;
use App\Models\CitiesGet;
use App\Models\AdminManageUsers;
use App\View\View;

class AdminChangeUserController
{  
    public static function adminShowUsersTable(): void
    {
        $users = (new UserGet)->getAllUsers();

        new View('adminshowusers', ['users' => $users, 'title' => 'Просмотр пользователей']);
    }

    public static function adminChangeUser(int $user_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = (new CitiesGet)->getAllCities();
            $user = (new UserGet)->getUser($user_id);

            new View('adminchangeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменение пользователя']);
        } else {
            $manage = new AdminManageUsers();

            if ($user_id != $_SESSION['user']['id']) {
                $manage->userBanManage($user_id, trim(strip_tags($_POST['ban_status'])));
                $manage->userAdminManage($user_id, trim(strip_tags($_POST['admin_status'])));
            }
            
            $check = (new UserValidation)->changeCheck(strip_tags($_POST['login']), null, null, strip_tags($_POST['email']));

            if (is_bool($check)) {
                $manage->userChangeByAdmin($user_id, trim(strip_tags($_POST['login'])), trim(strip_tags($_POST['email'])), 
                    trim(strip_tags($_POST['name'])),trim(strip_tags($_POST['surname'])), 
                        trim(strip_tags($_POST['city_id'])));

                header("Location: /admin/change/user/$user_id");
            } else {
                $_SESSION['user_err_msg'] = $check;

                header("Location: /admin/change/user/$user_id");
            }
        }
    }
}