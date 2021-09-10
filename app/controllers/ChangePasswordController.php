<?php
namespace App\Controllers;

use App\Models\PasswordChange;

class ChangePasswordController
{   
    /**
	 * Change user`s data by himself
     * @param int user id
	 * @return void
	 */

    public static function changePasswordController(string $link): void
    {
        if ((new PasswordChange())->changePassword($link)) {
            echo 'Ваш пароль успешно изменен <br> <a href="/user">Вернуться на Ваш профиль</a>';
        } else {
            header('Location: /');
        }
    }
}