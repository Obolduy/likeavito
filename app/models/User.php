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
        $info = $this->getOne('users', $id);

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
            $this->update("UPDATE users SET name_id = ? WHERE id = ?", [$elem['id'], $user_id]);
        }

        $data = $this->getOne('surnames', $user_id, 'user_id');

        foreach ($data as $elem) {
            $this->update("UPDATE users SET surname_id = ? WHERE id = ?", [$elem['id'], $user_id]);
        }
    }

    public function sendEmail(string $email): void
    {
        $link = md5($email . time());

        mail("<$email>", 'Закончите Вашу регистрацию', EMAIL_MESSAGE_START . $link . EMAIL_MESSAGE_END, implode("\r\n", EMAIL_HEADERS));
    }

    public function verifycationEmail(): void
    {
        $this->update("UPDATE users SET updated_at = now(), active = ? WHERE id = ?", [1, $_SESSION['user']['id']]);

        $this->setData($_SESSION['user']['id']);
    }

    public function setRememberToken(int $id): void
    {
        $remember_token = md5(rand() . time());

        $this->update("UPDATE users SET remember_token = ? WHERE id = ?", [$remember_token, $id]);

        setcookie('remember_token', $remember_token);
    }

    public function sendResetEmail(string $email): void
    {
        $info = $this->getOne('users', $email, 'email');

        foreach ($info as $elem) {
            $email = $elem['email'];
        }

        $link = md5($email . time());

        $this->setPasswordResetToken($email, $link);

        mail("<$email>", 'Восстановить пароль', EMAIL_MESSAGE_START . $link . EMAIL_MESSAGE_END, implode("\r\n", EMAIL_HEADERS)); // Подрихтовать текст
    }

    public function setPasswordResetToken(string $email, string $link): void
    {
        $query = $this->db->prepare("INSERT INTO password_reset SET email = ?, token = ?");
        $query->execute([$email, $link]);
    }

    public function resetPassword($password, string $token, string $email): void
    {
        $this->update("UPDATE users SET password = ?, updated_at = now() WHERE email = ?", [$password, $email]);
        $this->delete('password_reset', $token, 'token');
    }

     /**
	 * Get left join query with full user (or all users if ID is null) info (from 'users', 'names', 'surnames' and 'cities')
	 * @param int user`s id
	 * @return array
	 */

    public function getFullUserInfo(int $user_id = null)
    {
        if ($user_id !== null) {
            $query = $this->db->query("SELECT u.id, u.login, u.email, n.name, s.surname, c.city, u.city_id,
                u.registration_time, u.ban_status FROM users AS u
                    LEFT JOIN names AS n ON u.id = n.user_id
                        LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c ON c.id = u.city_id WHERE u.id = $user_id");
        } else {
            $query = $this->db->query("SELECT u.id, u.login, u.email, n.name, s.surname, c.city, u.city_id,
                u.registration_time, u.ban_status FROM users AS u
                    LEFT JOIN names AS n ON u.id = n.user_id
                        LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c ON c.id = u.city_id");
        }
             
        return $this->show($query);
    }

    /**
	 * Checks login availability, login`s and password`s content 
	 * @param string login
     * @param string email
     * @param string non-hashed password
     * @param string non-hashed confirmed password
	 * @return bool
	 */

    public static function registrationCheck(string $login, string $email, string $password, string $confirmPassword)
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        $base = new Model();

        if (!empty($login) and !empty($password)) {
            $emptyCheck = $base->getOne('users', $login, 'login');

            if (!empty($emptyCheck)) {
                echo 'Данный логин занят';
            } else {
                $emptyCheck = 1;
            }
            
            if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
                echo 'Пароль и логин могут содержать только латинские буквы и цифры';
            } else if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
                echo 'Проверьте правильность ввода Вашего Email';
            } else if (strlen($login) < 6 or strlen($login) > 32) {
                echo 'Логин должен состоять из 6-32 символов';
            } else if ($password != $confirmPassword) {
                echo 'Пароли не совпадают';
            } else {
                $correctCheck = 1;
            }
        }

        if ($emptyCheck === 1 and $correctCheck === 1) {
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

    public static function authCheck(string $login, string $password)
    {
        $base = new Model();

        try {
            $check = $base->getOne('users', $login, 'login');
        } catch (\Exception $e) {
            echo 'Пользователя с таким именем не существует.'; die();
        }

        foreach ($check as $elem) {
            $checkpassword = password_verify($password, $elem['password']);
        }

        if ($checkpassword === true) {
            return true;
        } else {
            echo 'Пароль неправильный.'; die();
        }
    }

    /**
	 * Validate login and password
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string current user login (before changing)
     * @param string email
	 * @return boolean
	 */

    public static function changeCheck(string $login, $password, $confirmPassword, string $current_login, string $email): bool
    {
        $emptyCheck = 0;
        $correctCheck = 0;

        if (!empty($login) and !empty($password)) {
            $emptyCheck = (new Model)->getOne('users', $login, 'login');

            foreach($emptyCheck as $elem) {
                if (!empty($emptyCheck) AND $elem['login'] != $current_login) {
                    echo 'Данный логин занят';
                }
            }
            
            $emptyCheck = 1;
            
            if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
                echo 'Пароль и логин могут содержать только латинские буквы и цифры';
            } else if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
                echo 'Проверьте правильность Вашего email';
            } else if (strlen($login) < 6 or strlen($login) > 32) {
                echo 'Логин должен состоять из 6-32 символов';
            } else if ($password != $confirmPassword) {
                echo 'Пароли не совпадают';
            } else {
                $correctCheck = 1;
            }
        }
        if ($emptyCheck === 1 and $correctCheck === 1) {
            return true;
        } else {
            return false;
        }
    }
}