<?php
namespace App\Models;

use App\Models\UserAuth;

class EmailVerify extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->verifycationEmail();
    }

    private function verifycationEmail(): UserAuth
    {
        $this->db->dbQuery("UPDATE users SET updated_at = now(), active = ? WHERE id = ?",
            [1, $_SESSION['user']['id']]);

        return new UserAuth();
    }
}