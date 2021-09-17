<?php
namespace App\Controllers;

use App\Models\EmailChanger;

class ChangeEmailController
{   
    public static function changeEmailController(string $link): void
    {
        if ((new EmailChanger)->changeEmail($link)) {
            echo 'Ваш Email успешно изменен <br> <a href="/user">Вернуться на Ваш профиль</a>';
        } else {
            header('Location: /');
        }
    }
}