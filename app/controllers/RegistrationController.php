<?php

require 'C:\OpenServer\domains\likeavito\app\models\Authorization.php';

class RegistrationController
{   
    public static function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\registration.php';
        } else {
            return Authorization::regUser();
        }
    }
}