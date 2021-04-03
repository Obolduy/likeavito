<?php
namespace App\Controllers;
use App\Models\User;

class ChangeUserController
{   
    /**
	 * Change user`s data by himself
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string new name
     * @param int user id
	 * @return boolean
	 */

    public function changeInformation(string $login, string $password, string $confirmPassword, string $name, int $user_id): string
    {
        $check = User::changeCheck(strip_tags($login), strip_tags($password), strip_tags($confirmPassword), $_SESSION['user']['login']);

        if ($check == true) {
            $cryptpassword = password_hash(strip_tags($password), PASSWORD_DEFAULT);
            
            $data = [strip_tags($login), $cryptpassword, strip_tags($name), $user_id];
    
            $user = new User();

            $user->updateUser("UPDATE users SET login = ?, password = ?, name = ?, update_time = now() WHERE id = ?", $data);

            $user_info = $base->getOne('users', $login, 'login');

            foreach($user_info as $elem) {
                $user->setData($elem['id']);

                $_SESSION['user'] = $user->data;
            }
    
            return 'Информация успешно изменена';
        }
    }
}