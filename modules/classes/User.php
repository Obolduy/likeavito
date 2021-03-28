<?php

require_once 'classes.php';

class User implements UserInterface
{
    public $data = [];

    public function __construct(int $id)
    {
        $base = new Base();

        $info = $base->getOne('users', $id);

        foreach ($info as $elem) {
            $this->data = ['id' => $elem['id'], 'login' => $elem['login'],
                       'password' => $elem['password'], 'name_id' => $elem['name_id'],
                       'email' => $elem['email'], 'surname_id' => $elem['surname_id'],
                       'city_id' => $elem['city_id'], 'status_id' => $elem['status_id'],
                       'ban_status' => $elem['ban_status'], 'registration_time' => $elem['registration_time'],
                       'updated_at' => $elem['updated_at'], 'active' => $elem['active']];
        }

        // Заменить на join
    }

    /*
    public function getUserTable($user_id)
    {
        $user = $this->base->getOne('users', $user_id);

        $content = "<br><form method=POST>
        Имя и фамилия: <input type=\"text\" name=\"name\" value=\"{$user['name']}\"><br><br>
        Логин: <input type=\"text\" name=\"login\" value=\"{$user['login']}\"><br><br>
        Пароль: <input type=\"password\" name=\"password\" value=\"\"><br><br>
        Подтвердите пароль: <input type=\"text\" name=\"confirmpassword\" value=\"\"><br><br>
        <input type=\"submit\" name=\"submit\">
        </form>";

        return $content;
    }
    */

    /**
	 * Change user`s data by himself
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string new name
     * @param int user id
	 * @return boolean
	 */

    public function changeInformation(string $login, string $password, string $confirmPassword, string $name, int $user_id)
    {
        $check = $this->changeCheck(strip_tags($login), strip_tags($password), strip_tags($confirmPassword), $this->data['login']);

        if ($check == true) {
            $cryptpassword = password_hash(strip_tags($password), PASSWORD_DEFAULT);
            
            $data = [strip_tags($login), $cryptpassword, strip_tags($name), $user_id];

            $base = new Base();
    
            $base->updateQuery("UPDATE users SET login = ?, password = ?, name = ?, update_time = now() WHERE id = ?", $data);
    
            return 'Информация успешно изменена';
        }
    }

    /**
	 * Validate login and password
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string current user login (before changing)
	 * @return boolean
	 */

    public function changeCheck(string $login, string $password, string $confirmPassword, string $current_login): bool
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        if (!empty($login) and !empty($password)) {
            $emptyCheck = $this->base->getOne('users', $login, 'login');

            foreach($emptyCheck as $elem) {
                if (!empty($emptyCheck) AND $elem['login'] != $current_login) {
                    echo 'Данный логин занят';
                } else {
                    $emptyCheck = 1;
                }
            }
            
            if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
                echo 'Пароль и логин могут содержать только латинские буквы и цифры';
            } else if (strlen($login) < 6 or strlen($login) > 32) {
                echo 'Логин должен состоять из 6-32 символов';
            } else if ($password != $confirmPassword) {
                echo 'Пароли не совпадают';
            } else {
                $correctCheck = 1;
            }
        }
        if ($emptyCheck == 1 and $correctCheck == 1) {
            return true;
        }
    }
}
