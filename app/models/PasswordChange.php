<?php
namespace App\Models;

class PasswordChange extends Model
{
    public $email, $password;

    public function __construct(string $email = null, string $password = null)
    {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }

    public function setPasswordResetToken(string $link): void
    {
        $this->db->dbQuery("INSERT INTO password_reset SET email = ?, token = ?",
            [$this->email, $link]);
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

    public function changePassword(string $link): bool
    {
        $newPassword = $this->db->dbQuery("SELECT * FROM passwords_changes WHERE link = ?", [$link])->fetch();
        
        if ($newPassword) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), password = ? WHERE id = ?",
                [$newPassword['password'], $_SESSION['user_id']]);
            return true;
        } else {
            return false;
        }
    }

    public function addPasswordToChangeTable(): void
    {
        $this->db->dbQuery('INSERT INTO passwords_changes SET email = ?, password = ?, link = ?, request_time = now()',
            [$this->email, $this->password, $_SESSION['changepassword_link']]);
    }
}