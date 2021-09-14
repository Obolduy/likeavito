<?php
namespace App\Models;

use App\Models\Database;
use App\Models\UserGet;
use App\Models\UserAuth;

class UserLogin
{
    private $login;
    private $db;

    public function __construct(string $login)
    {
        $this->login = $login;
        $this->db = new Database();
    }

    public function login(int $rememberToken = 0): void
    {
        $user = (new UserGet)->getUserByKey(['login' => $this->login]);

        foreach ($user as $elem) {
            $_SESSION['user_id'] = $elem['id'];
        }

        if ($rememberToken == 1) {
            $remember_token = md5(rand() . time());

            $this->db->dbQuery("UPDATE users SET remember_token = ? WHERE id = ?",
                [$remember_token, $_SESSION['user_id']]);

            setcookie('remember_token', $remember_token, time()+2678400);
        }

        $_SESSION['user'] = (new UserAuth)->data;
        $_SESSION['userauth'] = true;
    }
}