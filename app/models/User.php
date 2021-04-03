<?php
namespace App\Models;

class User extends Model
{
    public $data = [];

    public function __construct()
    {
        $this->db = self::connection();
    }

    public function setData(int $id): void
    {
        $info = $this->db->getOne('users', $id);

        foreach ($info as $elem) {
            $this->data = ['id' => $elem['id'], 'login' => $elem['login'],
                    'password' => $elem['password'], 'name_id' => $elem['name_id'],
                    'email' => $elem['email'], 'surname_id' => $elem['surname_id'],
                    'city_id' => $elem['city_id'], 'status_id' => $elem['status_id'],
                    'ban_status' => $elem['ban_status'], 'registration_time' => $elem['registration_time'],
                    'updated_at' => $elem['updated_at'], 'active' => $elem['active']];
        }
    }

    /**
	 * Adding new user into db
	 * @param string login
     * @param string hashed password
     * @param string name
     * @param int user`s city id
	 * @return void
	 */

    public function addUser(string $login, string $password, string $email, int $city_id): void
    {
        $query = $this->db->prepare("INSERT INTO users SET email = ?, password = ?, city_id = ?, status_id = 1,
            ban_status = 0, active = 0, registration_time = NOW(), login = ?");
        $query->execute([$email, $password, $city_id, $login]);
    }

    /**
	 * Adding data into names\surnames tables and updating users table
	 * @param string name
     * @param string surnames
     * @param int user`s id
	 * @return void
	 */

    public function addUserInfo(string $name, string $surname, int $user_id): void
    {
        $query = $this->db->prepare("INSERT INTO names SET name = ?, user_id = ?");
        $query->execute([$name, $user_id]);

        $query = $this->db->prepare("INSERT INTO surnames SET surname = ?, user_id = ?");
        $query->execute([$surname, $user_id]);

        $data = $this->getOne('names', $user_id, 'user_id');
        
        foreach ($data as $elem) {
            $this->updateQuery("UPDATE users SET name_id = ? WHERE id = ?", [$elem['id'], $user_id]);
        }

        $data = $this->getOne('surnames', $user_id, 'user_id');

        foreach ($data as $elem) {
            $this->updateQuery("UPDATE users SET surname_id = ? WHERE id = ?", [$elem['id'], $user_id]);
        }
    }

    public function updateUser(string $query, array $data): void
    {
        $query = $this->db->prepare("$query");
        $query->execute($data);
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
	 * Validate login and password
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string current user login (before changing)
	 * @return boolean
	 */

    public static function changeCheck(string $login, string $password, string $confirmPassword, string $current_login): bool
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        if (!empty($login) and !empty($password)) {
            $emptyCheck = Model::getOne('users', $login, 'login');

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

    /**
	 * Checks login availability, login`s and password`s content 
	 * @param string login
     * @param string non-hashed password
     * @param string non-hashed confirmed password
	 * @return bool
	 */

    public static function registrationCheck(string $login, string $password, string $confirmPassword)
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        $base = Model::connection();

        if (!empty($login) and !empty($password)) {
            $emptyCheck = $base->getOne('users', $login, 'login');

            if (!empty($emptyCheck)) {
                echo 'Данный логин занят';
            } else {
                $emptyCheck = 1;
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
        } else {
            return false;
        }
    }

    /**
	 * Validate login and password
	 * @param string login
     * @param string non-hashed password
	 * @return bool
	 */

    protected static function authCheck(string $login, string $password): bool
    {
        $base = Model::connection();

        $check = $base->getOne('users', $login, 'login');

        if (!empty($check)) {
            $user = $base->selectQuery("SELECT * FROM users WHERE login = '$login'");

            foreach($user as $elem) {
                $checkpassword = password_verify($password, $elem['password']);
            }

            if (!empty($user) and $checkpassword == true) {
                return true;
            } else {
                echo 'Неправильный логин или пароль';
            }
        }
    }
}