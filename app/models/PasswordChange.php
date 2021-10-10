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

    public function changePassword(string $link, int $userId): bool
    {
        $newPassword = $this->db->dbQuery("SELECT * FROM passwords_changes WHERE link = ?", [$link])->fetch();
        
        if ($newPassword) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), password = ? WHERE id = ?",
                [$newPassword['password'], $userId]);
            return true;
        } else {
            return false;
        }
    }

    public function addPasswordToChangeTable(string $link): void
    {
        $this->db->dbQuery('INSERT INTO passwords_changes SET email = ?, password = ?, link = ?, request_time = now()',
            [$this->email, $this->password, $link]);
    }
}