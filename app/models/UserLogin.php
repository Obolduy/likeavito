<?php
namespace App\Models;
use App\Models\User;
use App\Models\AuthUser;

class UserRegistration
{
    private $login;

    public function __construct(string $login)
    {
        $this->login = $login;
    }

    public function login()
    {
        $user = (new User)->getUserByKey(['login' => $this->login]);

        foreach ($user as $elem) {
            $_SESSION['user_id'] = $elem['id'];
        }

        $_SESSION['user'] = (new AuthUser)->data;
        $_SESSION['userauth'] = true;
    }
}