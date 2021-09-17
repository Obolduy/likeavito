<?php
namespace App\Models;

class PasswordValidation extends Model
{
    private $errorArray = [];

    public function checkPassword(string $password, string $confirmPassword)
    {
        if (!preg_match('#^[A-Za-z0-9]+$#', $password)) {
            $this->errorArray[] = 'Пароль может содержать только латинские буквы и цифры';
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