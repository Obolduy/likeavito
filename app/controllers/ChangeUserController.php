<?php
namespace App\Controllers;

use App\Models\UserGet;
use App\Models\UserValidation;
use App\Models\Picture;
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
        $user = (new UserGet)->getUser($_SESSION['user']['id']);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cities = (new Cities)->getAllCities();

            new View('changeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменить данные']);
        } else {
            $check = (new UserValidation)->changeCheck(strip_tags($_POST['login']), strip_tags($_POST['password']),
                strip_tags($_POST['confirmPassword']), strip_tags($_POST['email']));

            if (is_bool($check)) {
                if ($_POST['password']) {
                    $cryptpassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
                } else {
                    $cryptpassword = null;
                }

                $avatar = null;
                if ($_FILES['photo']['name'] != '') {
                    $picture = new Picture();
                    $picture->deletePicturesByPath("users/{$_SESSION['user']['id']}/{$user['avatar']}");
                    $avatar = $picture->uploadPicture("users/{$_SESSION['user']['id']}", $_FILES['photo']);
                }

                (new UserManipulate)->changeUser($_SESSION['user']['id'], $_SESSION['user']['email'], strip_tags($_POST['login']),
                    $cryptpassword, strip_tags($_POST['email']), strip_tags($_POST['name']),
                        strip_tags($_POST['surname']), $_POST['city_id'], $avatar[0]);
            } else {
                $_SESSION['user_err_msg'] = $check;

                header('Location: /user/change'); die();
            }
            
            header('Location: /user');
        }
    }
}