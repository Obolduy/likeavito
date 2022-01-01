<?php
namespace App\Models;

class UserValidation extends Model
{
    private $errorArray = [];

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
            $this->errorArray[] = 'Пользователя с таким логином не существует';
            return $this->errorArray;
        }

        $checkpassword = password_verify($password, $user['password']);

        if ($checkpassword != true) {
            $this->errorArray[] = 'Пароль неправильный';
            return $this->errorArray;
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
        $this->registrationEmailFieldValidation($email);
        $this->registrationLoginFieldValidation($login);
        $this->registrationPasswordFieldsValidation($password, $confirmPassword);

        if ($email == $login) {
            $this->errorArray[] = 'Логин не может совпадать с паролем';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        }

        return true;
    }

    /**
	 * Validate login and password
	 * @param string new login
     * @param string new non-hashed password
     * @param string non-hashed password confirm
     * @param string email
	 * @return array|boolean
	 */

    public function changeCheck(string $login, ?string $password, ?string $confirmPassword, string $email)
    {
        $emptyLoginCheck = $this->db->dbQuery("SELECT login FROM users WHERE login = ?", [$login])
            ->fetchColumn();

        $emptyEmailCheck = $this->db->dbQuery("SELECT email FROM users WHERE email = ?", [$email])
            ->fetchColumn();

        if ($emptyLoginCheck != null && $emptyLoginCheck != $login) {
            $this->errorArray[] = 'Данный логин занят';
        }

        if ($emptyEmailCheck != null && $emptyEmailCheck != $email) {
            $this->errorArray[] = 'Данный email занят';
        }
        
        if ($password && $confirmPassword) {
            if (!preg_match('#^[A-Za-z0-9]+$#', $password)) {
                $this->errorArray[] = 'Пароль может содержать только латинские буквы и цифры';
            }

            if ($password != $confirmPassword) {
                $this->errorArray[] = 'Пароли не совпадают';
            }
        }

        if (!preg_match('#^[A-Za-z0-9]+$#', $login)) {
            $this->errorArray[] = 'Логин может содержать только латинские буквы и цифры';
        } 
        
        if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
            $this->errorArray[] = 'Проверьте правильность Вашего email';
        }
        
        if (strlen($login) < 6 or strlen($login) > 32) {
            $this->errorArray[] = 'Логин должен состоять из 6-32 символов';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        } else {
            return true;
        }
    }

    /**
	 * Calling validation methods in case of ajax field name
     * @param array fields
	 * @return string json with errors
	 */

    public function ajaxRegistrationChecker(array $field): string
    {
        switch ($field['fieldName']) {
            case 'login':
                $this->registrationLoginFieldValidation($field['fieldValue']);
            case 'email':
                $this->registrationEmailFieldValidation($field['fieldValue']);
            case 'password':
            case 'confirmPassword':
                $this->registrationPasswordFieldsValidation(
                    $field['fieldValue']['password'], $field['fieldValue']['confirmPassword']
                );
        }

        if (!$this->errorArray) {
            $this->errorArray = 0;
        }

        return json_encode($this->errorArray, JSON_UNESCAPED_UNICODE);
    }

    /**
	 * Validate regstration email
     * @param string email
	 * @return void
	 */

    private function registrationEmailFieldValidation(string $email): void
    {
        $emailCheck = $this->db->dbQuery("SELECT email FROM users WHERE email = ?", [$email])
            ->fetchColumn();

        if (!empty($emailCheck)) {
            $this->errorArray[] = 'Данный Email занят';
        }

        if (!preg_match('#^[A-Za-z0-9_-]+@.+\..{2,4}$#', $email)) {
            $this->errorArray[] = 'Проверьте правильность ввода Вашего Email';
        }
    }

    /**
	 * Validate regstration login
     * @param string login
	 * @return void
	 */

    private function registrationLoginFieldValidation(string $login): void
    {
        $loginCheck = $this->db->dbQuery("SELECT login FROM users WHERE login = ?", [$login])
            ->fetchColumn();

        if (!empty($loginCheck)) {
            $this->errorArray[] = 'Данный логин занят';
        }

        if (strlen($login) < 6 or strlen($login) > 32) {
            $this->errorArray[] = 'Логин должен состоять из 6-32 символов';
        }

        if (!preg_match('#^[A-Za-z0-9]+$#', $login)) {
            $this->errorArray[] = 'Логин может содержать только латинские буквы и цифры';
        }
    }

    /**
	 * Validate regstration password and password confirmation
     * @param string password
     * @param string confirmPassword
	 * @return void
	 */

    private function registrationPasswordFieldsValidation(string $password, string $passwordVerify): void
    {
        if (!preg_match('#^[A-Za-z0-9]+$#', $password)) {
            $this->errorArray[] = 'Пароль может содержать только латинские буквы и цифры';
        }
        
        if ($password != $passwordVerify) {
            $this->errorArray[] = 'Пароли не совпадают';
        }
    }
}