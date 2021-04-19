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

    public function changeInformation(string $login, string $password, string $confirmPassword, string $name, string $surname, $email, int $user_id): void
    {
        $check = User::changeCheck(strip_tags($login), strip_tags($password), strip_tags($confirmPassword), $_SESSION['user']['login'], strip_tags($email));

        if ($check == true) {
            $cryptpassword = password_hash(strip_tags($password), PASSWORD_DEFAULT);
            
            $data = [strip_tags($login), $cryptpassword, strip_tags($email), $user_id];
    
            $user = new User();

            $user->update("UPDATE users SET login = ?, password = ?, email = ?, updated_at = now() WHERE id = ?", $data);
            $user->update("UPDATE names SET name = ? WHERE user_id = ?", [strip_tags($name), $user_id]);
            $user->update("UPDATE surnames SET surname = ? WHERE user_id = ?", [strip_tags($surname), $user_id]);

            $user_info = $user->getOne('users', $user_id);

            foreach($user_info as $elem) {
                $user->setData($elem['id']);

                $_SESSION['user'] = $user->data;
            }
        }
    }
}