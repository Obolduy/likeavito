<?php
namespace App\Models;

use App\Models\SendResetEmail;

class PasswordReset extends Model
{
    public $email, $password;

    public function __construct(string $email = null, string $password = null)
    {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }

    public function passwordResetRequest(string $token): void
    {
        $this->db->dbQuery("INSERT INTO password_reset SET email = ?, token = ?",
            [$this->email, $token]);

        $emailData = json_encode([$this->email, $token]);
        $queue = new SendResetEmail();
        $queue->createQueue('send_reset_email');
        $queue->sendMessage($emailData);
        $queue->closeConnection();
    }

    public function resetPassword(string $token): void
    {
        $this->db->dbQuery("UPDATE users SET password = ?, updated_at = now() WHERE email = ?",
            [$this->password, $this->email]);
        $this->db->dbQuery('DELETE FROM password_reset WHERE token = ?', [$token]);
    }

    public function getEmailByToken(string $token): void
    {
        $this->email = $this->db->dbQuery("SELECT email FROM password_reset WHERE token = ?", [$token])
            ->fetchColumn();
    }
}