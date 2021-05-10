<?php
namespace App\Controllers;
use App\Models\UserApi;

class ApiGetUserController
{  
    public static function apiGetUser(int $user_id)
    {
        $user = new UserApi();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $user->getUserInfo($user_id);
    }
}