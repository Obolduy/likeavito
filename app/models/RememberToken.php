<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class RememberToken
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function setRememberToken(int $id): void
    {
        $remember_token = md5(rand() . time());

        $this->db->dbQuery("UPDATE users SET remember_token = ? WHERE id = ?",
            [$remember_token, $id]);

        setcookie('remember_token', $remember_token, time()+2678400);
    }
}