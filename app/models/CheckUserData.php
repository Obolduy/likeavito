<?php
namespace App\Models;

class CheckUserData
{
    /**
	 * Validate login and password
	 * @param string login
     * @param string non-hashed password
	 * @return bool|string
	 */

    public function authCheck(string $login, string $password)
    {       
        $check = $this->getOne('users', $login, 'login');

        if (!$check) {
            return 'Пользователя с таким логином не существует';
        }

        foreach ($check as $elem) {
            $checkpassword = password_verify($password, $elem['password']);
        }

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
        $errorArray = [];

        $loginCheck = $this->getOne('users', $login, 'login');
        $emailCheck = $this->getOne('users', $email, 'email');

        if (!empty($loginCheck)) {
            $errorArray[] = 'Данный логин занят';
        }

        if (!empty($emailCheck)) {
            $errorArray[] = 'Данный Email занят';
        }
        
        if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
            $errorArray[] = 'Пароль и логин могут содержать только латинские буквы и цифры';
        }

        if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
            $errorArray[] = 'Проверьте правильность ввода Вашего Email';
        }

        if ($email == $login) {
            $errorArray[] = 'Логин не может совпадать с паролем';
        }

        if (strlen($login) < 6 or strlen($login) > 32) {
            $errorArray[] = 'Логин должен состоять из 6-32 символов';
        }

        if ($password != $confirmPassword) {
            $errorArray[] = 'Пароли не совпадают';
        }

        if (!empty($errorArray)) {
            return $errorArray;
        } else {
            return true;
        }
    }

    /**
	 * Validate login and password
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string current user login (before changing)
     * @param string email
	 * @return array|boolean
	 */

    public function changeCheck(string $login, $password, $confirmPassword, string $current_login, string $email)
    {
        $errorArray = [];

        $emptyCheck = $this->getOne('users', $login, 'login');

        if ($emptyCheck != null && $emptyCheck[0]['login'] != $login) {
            $errorArray[] = 'Данный логин занят';
        }

        if ($emptyCheck != null && $emptyCheck[0]['email'] != $email) {
            $errorArray[] = 'Данный email занят';
        }
        
        if (!preg_match('#^[A-Za-z0-9]+$#', $login) or !preg_match('#^[A-Za-z0-9]+$#', $password)) {
            $errorArray[] = 'Пароль и логин могут содержать только латинские буквы и цифры';
        } 
        
        if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
            $errorArray[] = 'Проверьте правильность Вашего email';
        }
        
        if (strlen($login) < 6 or strlen($login) > 32) {
            $errorArray[] = 'Логин должен состоять из 6-32 символов';
        }
        
        if ($password != $confirmPassword) {
            $errorArray[] = 'Пароли не совпадают';
        }

        if (!empty($errorArray)) {
            return $errorArray;
        } else {
            return true;
        }
    }
}