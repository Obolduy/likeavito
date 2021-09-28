<?php
namespace App\Controllers;

use App\Models\UserGet;
use App\Models\UserValidation;
use App\Models\Cities;
use App\Models\UserManipulate;
use App\View\View;

class ChangeUserController
{   
    /**
	 * Change user`s data by himself
     * @param int user id
	 * @return void
	 */

    public static function changeInformation(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = (new UserGet)->getUser($_SESSION['user']['id']);
            $cities = (new Cities)->getAllCities();

            new View('changeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменить данные']);
        } else {
            $check = (new UserValidation)->changeCheck(strip_tags($_POST['login']), strip_tags($_POST['password']),
                strip_tags($_POST['confirmPassword']), strip_tags($_POST['email']));

            if ($check == true) {
                $cryptpassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT) ?? null;

                (new UserManipulate())->changeUser($_SESSION['user']['id'], strip_tags($_POST['login']),
                    $cryptpassword, strip_tags($_POST['email']), strip_tags($_POST['name']),
                        strip_tags($_POST['surname']), $_POST['city_id'], $_FILES['photo']);
            } else {
                $_SESSION['usr_err_msg'] = $check;

                header('Location: /user/change');
            }

            header('Location: /user');
        }
    }
}