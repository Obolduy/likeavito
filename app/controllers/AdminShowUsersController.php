<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class AdminShowUsersController
{   
    public function adminShowUsersTable()
    {
        $list = (new User)->getAll('users');

        new View('adminshowusers');
    }
}