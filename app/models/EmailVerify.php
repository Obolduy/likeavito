<?php
namespace App\Models;

use App\Models\Database;
use App\Models\UserAuth;

class EmailVerify
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();

        $this->verifycationEmail();
    }

    private function verifycationEmail(): UserAuth
    {
        $this->db->dbQuery("UPDATE users SET updated_at = now(), active = ? WHERE id = ?",
            [1, $_SESSION['user']['id']]);

        return new UserAuth();
    }
}