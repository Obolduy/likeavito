<?php
namespace App\Models;

class EmailVerify extends Model
{
    private $token;

    public function __construct(string $token)
    {
        parent::__construct();

        $this->token = $token;
        $this->verifycationEmail();
    }

    private function verifycationEmail(): bool
    {
        if ($userId = $this->checkToken()) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), active = 1 WHERE id = ?",
                [$userId]);
            $this->db->dbQuery("UPDATE registration_tokens SET activated = 1 WHERE token = ?",
                [$this->token]);

            return true;
        } else {
            return false;
        }
    }

    private function checkToken()
    {
        $user = $this->db->dbQuery("SELECT user_id FROM registration_tokens WHERE token = ?", [$this->token])->fetchColumn();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }
}