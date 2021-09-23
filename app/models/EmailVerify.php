<?php
namespace App\Models;

use App\Models\UserAuth;

class EmailVerify extends Model
{
    private $token;

    public function __construct(string $token)
    {
        parent::__construct();

        $this->token = $token;
        $this->verifycationEmail();
    }

    private function verifycationEmail(): UserAuth
    {
        if ($this->checkToken()) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), active = 1 WHERE id = ?",
                [$_SESSION['user_id']]);
            $this->db->dbQuery("UPDATE registration_tokens SET activated = 1 WHERE token = ?",
                [$this->token]);

            return new UserAuth();
        } else {
            return false;
        }
    }

    private function checkToken(): bool
    {
        if ($this->db->dbQuery("SELECT token FROM registration_tokens WHERE token = ?", [$this->token])->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }
}