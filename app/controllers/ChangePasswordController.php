<?php
namespace App\Controllers;

use App\Models\PasswordChange;

class ChangePasswordController
{   
    /**
	 * Change user`s password by himself
     * @param string link-token
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