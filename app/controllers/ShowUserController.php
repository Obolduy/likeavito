<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class ShowUserController
{   
    public function showUser()
    {
        $user = User::showUser($_SESSION['user']['id']);

        new View('user');
    }
}