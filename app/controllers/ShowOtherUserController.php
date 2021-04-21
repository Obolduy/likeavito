<?php
namespace App\Controllers;
use App\Models\User;
use App\View\View;

class ShowUserController
{   
    public function showOtherUser(int $user_id)
    {
        $user = User::showOtherUser($user_id);

        new View('otheruser');
    }
}