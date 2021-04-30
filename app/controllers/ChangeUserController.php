<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class ChangeUserController
{   
    /**
	 * Change user`s data by himself
     * @param int user id
	 * @return void
	 */

    public static function changeInformation(int $user_id): void
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = $user->getFullUserInfo($user_id);

            new View('changelot', ['lot' => $lot, 'categories' => $categories, 'title' => 'Изменить данные']);
        } else {
            $check = User::changeCheck(strip_tags($_POST['login']), strip_tags($_POST['password']),
                strip_tags($_POST['confirmPassword']), $_SESSION['user']['login'], strip_tags($_POST['email']));

            if ($check == true) {
                $cryptpassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
                
                $data = [strip_tags($_POST['login']), $cryptpassword, strip_tags($_POST['email']), $user_id];

                $user->update("UPDATE users SET login = ?, password = ?, email = ?, updated_at = now() WHERE id = ?", $data);
                $user->update("UPDATE names SET name = ? WHERE user_id = ?", [strip_tags($_POST['name']), $user_id]);
                $user->update("UPDATE surnames SET surname = ? WHERE user_id = ?", [strip_tags($_POST['surname']), $user_id]);

                $user_info = $user->getOne('users', $user_id);

                foreach($user_info as $elem) {
                    $user->setData($elem['id']);

                    $_SESSION['user'] = $user->data;
                }
            }
        }
    }
}