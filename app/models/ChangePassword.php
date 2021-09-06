<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class ChangePassword
{
    private $email;
    private $password;
    private $db;

    public function __construct(string $email, string $password = null, iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
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

    public function changePassword(string $link)
    {
        $new_password = $this->db->dbQuery("SELECT * FROM passwords_changes WHERE link = ?", [$link]);
        
        if ($new_password) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), password = ? WHERE id = ?",
                [$new_password[0]['password'], $_SESSION['user']['id']]);
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