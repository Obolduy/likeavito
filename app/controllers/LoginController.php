<?php

require 'C:\OpenServer\domains\likeavito\app\models\Authorization.php';

class LoginController
{   
    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\login.php';
        } else {
            return Authorization::logIn();
        }
    }
}