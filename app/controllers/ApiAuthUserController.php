<?php
namespace App\Controllers;
use App\Models\UserApi;

class ApiAuthUserController
{  
    public static function apiLoginUser()
    {
        $user = new UserApi();

        header('HTTP/1.0 200');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $user->userLogin(strip_tags($_POST['login']), strip_tags($_POST['password']));
    }
}