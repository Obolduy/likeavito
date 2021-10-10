<?php
namespace App\Models;

class EmailChanger extends Model
{
    public function addEmailToChangeTable(string $newEmail, string $currentEmail, string $link): void
    {
        $this->db->dbQuery('INSERT INTO emails_changes SET new_email = ?, current_email = ?, link = ?, request_time = now()',
            [$newEmail, $currentEmail, $link]);
    }

    public function changeEmail(string $link, int $userId): bool
    {
        if ($newEmail = $this->db->dbQuery("SELECT * FROM emails_changes WHERE link = ?", [$link])->fetch()) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), email = ? WHERE id = ?",
                [$newEmail['new_email'], $userId]);

            return true;
        } else {
            return false;
        }
    }
}