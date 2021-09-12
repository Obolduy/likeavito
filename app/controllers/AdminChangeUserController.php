<?php
namespace App\Controllers;

use App\Models\AdminManageLots;
use App\Models\UserGet;
use App\Models\UserValidation;
use App\Models\UserManipulate;
use App\Models\Cities;
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
            $cities = (new Cities)->getAllCities();
            $user = (new UserGet)->getUserInfo($user_id);

            new View('adminchangeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменение пользователя']);
        } else {           
            $check = (new UserValidation)->changeCheck(strip_tags($_POST['login']), strip_tags($_POST['password']),
                strip_tags($_POST['confirmPassword']), strip_tags($_POST['email']));

            if ($check == true) {
                $cryptpassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);

                (new UserManipulate())->changeUser($user_id, strip_tags($_POST['login']),
                    $cryptpassword, strip_tags($_POST['email']), strip_tags($_POST['name']),
                        strip_tags($_POST['surname']), $_POST['city_id'], $_FILES['photo']);

                (new AdminManageUsers)->userBanManage($user_id, $_POST['ban']);
            } else {
                $_SESSION['usr_err_msg'] = $check;

                header('Location: /user/change');
            }

            header('Location: /user');
        }
    }
}