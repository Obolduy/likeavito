<?php
namespace App\Models;

class UserValidation extends Model
{
    /**
	 * Validate login and password
	 * @param string login
     * @param string non-hashed password
	 * @return bool|string
	 */

    public function authCheck(string $login, string $password)
    {       
        $user = $this->db->dbQuery("SELECT * FROM users WHERE login = ?", [$login])->fetch();

        if (!$user) {
            return 'Пользователя с таким логином не существует';
        }

        $checkpassword = password_verify($password, $user['password']);

        if ($checkpassword !== true) {
            return 'Пароль неправильный';
        }

        return true;
    }

    /**
	 * Checks login availability, login`s and password`s content 
	 * @param string login
     * @param string email
     * @param string non-hashed password
     * @param string non-hashed confirmed password
	 * @return array|bool
	 */

    public function registrationCheck(string $login, string $email, string $password, string $confirmPassword)
    {
        $loginCheck = $this->db->dbQuery("SELECT login FROM users WHERE login = ?", [$login])
            ->fetchColumn();
        $emailCheck = $this->db->dbQuery("SELECT email FROM users WHERE email = ?", [$email])
            ->fetchColumn();

        if (!empty($loginCheck)) {
            $this->errorArray[] = 'Данный логин занят';
        }

        if (!empty($emailCheck)) {
            $this->errorArray[] = 'Данный Email занят';
        }
        
        if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
            $this->errorArray[] = 'Пароль и логин могут содержать только латинские буквы и цифры';
        }

        if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
            $this->errorArray[] = 'Проверьте правильность ввода Вашего Email';
        }

        if ($email == $login) {
            $this->errorArray[] = 'Логин не может совпадать с паролем';
        }

        if (strlen($login) < 6 or strlen($login) > 32) {
            $this->errorArray[] = 'Логин должен состоять из 6-32 символов';
        }

        if ($password != $confirmPassword) {
            $this->errorArray[] = 'Пароли не совпадают';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        } else {
            return true;
        }
    }

    /**
	 * Validate login and password
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string email
	 * @return array|boolean
	 */

    public function changeCheck(string $login, $password, $confirmPassword, string $email)
    {
        $emptyCheck = $this->db->dbQuery("SELECT login, email FROM users WHERE login = ?", [$login])
            ->fetchAll();

        foreach ($emptyCheck as $elem) {
            if ($emptyCheck != null && $elem['login'] != $login) {
                $this->errorArray[] = 'Данный логин занят';
            }
    
            if ($emptyCheck != null && $elem['email'] != $email) {
                $this->errorArray[] = 'Данный email занят';
            }
        }
        
        if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
            $this->errorArray[] = 'Пароль и логин могут содержать только латинские буквы и цифры';
        } 
        
        if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
            $this->errorArray[] = 'Проверьте правильность Вашего email';
        }
        
        if (strlen($login) < 6 or strlen($login) > 32) {
            $this->errorArray[] = 'Логин должен состоять из 6-32 символов';
        }
        
        if ($password != $confirmPassword) {
            $this->errorArray[] = 'Пароли не совпадают';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        } else {
            return true;
        }
    }
}