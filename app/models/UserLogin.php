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

    public function login(int $rememberToken = null): array
    {
        $user = (new UserGet)->getUserByLogin($this->login);

        if ($rememberToken) {
            $remember_token = md5(rand() . time());

            $this->db->dbQuery("UPDATE users SET remember_token = ? WHERE id = ?",
                [$remember_token, $user['id']]);

            setcookie('remember_token', $remember_token, time()+2678400); // set cookie for a month
            $_COOKIE['remember_token'] = $remember_token;
        }

        return ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email'], 'active' => $user['active'], 'ban_status' => $user['ban_status']];
    }
}