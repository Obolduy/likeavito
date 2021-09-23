<?php
namespace App\Models;

class EmailChanger extends Model
{
    public function addEmailToChangeTable(string $newEmail, string $currentEmail): void
    {
        $this->db->dbQuery('INSERT INTO emails_changes SET new_email = ?, current_email = ?, link = ?, request_time = now()',
            [$newEmail, $currentEmail, $_SESSION['changeemail_link']]);
    }

    public function changeEmail(string $link): bool
    {
        if ($newEmail = $this->db->dbQuery("SELECT * FROM emails_changes WHERE link = ?", [$link])->fetch()) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), email = ? WHERE id = ?",
                [$newEmail['new_email'], $_SESSION['user_id']]);

            return true;
        } else {
            return false;
        }
    }
}