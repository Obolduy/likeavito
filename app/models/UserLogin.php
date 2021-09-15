<?php
namespace App\Models;

use App\Models\UserGet;

class UserLogin extends Model
{
    private $login;

    public function __construct(string $login)
    {
        parent::__construct();
        $this->login = $login;
    }

    public function login(int $rememberToken = null): void
    {
        $user = (new UserGet)->getUserByKey(['login' => $this->login]);

        $_SESSION['user_id'] = $user['id'];

        if ($rememberToken) {
            $remember_token = md5(rand() . time());

            $this->db->dbQuery("UPDATE users SET remember_token = ? WHERE id = ?",
                [$remember_token, $_SESSION['user_id']]);

            setcookie('remember_token', $remember_token, time()+2678400);
            $_COOKIE['remember_token'] = $remember_token;
        }

        $_SESSION['userauth'] = true;
    }
}