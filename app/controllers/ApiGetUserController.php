<?php
namespace App\Controllers;

use App\Models\ApiUserGet;

class ApiGetUserController
{  
    /**
     * Get user by id
     * @param int user`s id
     * @return string JSON \w user information 
     */
    
    public static function apiGetUser(int $user_id)
    {
        $user = new ApiUserGet();

        header('HTTP/1.0 201');
        header('Content-Type: application/json; charset=UTF-8');
    
        echo $user->getUserInfo($user_id);
    }
}