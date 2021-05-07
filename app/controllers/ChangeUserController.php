<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Model;
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
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = $user->getFullUserInfo($_SESSION['user']['id']);
            $cities = (new Model)->getAll('cities');

            new View('changeuser', ['user' => $user, 'cities' => $cities, 'title' => 'Изменить данные']);
        } else {
            $check = User::changeCheck(strip_tags($_POST['login']), strip_tags($_POST['password']),
                strip_tags($_POST['confirmPassword']), $_SESSION['user']['login'], strip_tags($_POST['email']));

            if ($check == true) {
                $cryptpassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
                
                $data = [strip_tags($_POST['login']), $cryptpassword, strip_tags($_POST['email']), $_SESSION['user']['id']];

                $user->update("UPDATE users SET login = ?, password = ?, email = ?, updated_at = now() WHERE id = ?", $data);
                $user->update("UPDATE names SET name = ? WHERE user_id = ?", [strip_tags($_POST['name']), $_SESSION['user']['id']]);
                $user->update("UPDATE surnames SET surname = ? WHERE user_id = ?", [strip_tags($_POST['surname']), $_SESSION['user']['id']]);

                $user_info = $user->getOne('users', $_SESSION['user']['id']);

                foreach($user_info as $elem) {
                    $user->setData($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
            }
        }
    }
}