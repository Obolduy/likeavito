<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;
use App\Models\User;
use App\Models\AuthUser;

class UserLogin
{
    private $login;
    private $db;

    public function __construct(string $login, iDatabase $db = null)
    {
        $this->login = $login;
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function login(int $rememberToken = 0): void
    {
        $user = (new User)->getUserByKey(['login' => $this->login]);

        foreach ($user as $elem) {
            $_SESSION['user_id'] = $elem['id'];
        }

        if ($rememberToken == 1) {
            $remember_token = md5(rand() . time());

            $this->db->dbQuery("UPDATE users SET remember_token = ? WHERE id = ?",
                [$remember_token, $_SESSION['user_id']]);

            setcookie('remember_token', $remember_token, time()+2678400);
        }

        $_SESSION['user'] = (new AuthUser)->data;
        $_SESSION['userauth'] = true;
    }
}