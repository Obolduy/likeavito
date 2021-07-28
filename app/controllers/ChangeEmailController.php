<?php
namespace App\Controllers;
use App\Models\User;

class ChangeEmailController
{   
    /**
	 * Change user`s data by himself
     * @param int user id
	 * @return void
	 */

    public static function changeEmailController(string $link): void
    {
        if (!is_bool((new User)->changeEmail($link))) {
            echo 'Ваш Email успешно изменен <br> <a href="/user">Вернуться на Ваш профиль</a>';
        } else {
            header('Location: /');
        }
    }
}