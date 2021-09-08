<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class EmailChanger
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function addEmailToChangeTable(string $new_email, string $current_email): void
    {
        $this->db->dbQuery('INSERT INTO emails_changes SET new_email = ?, current_email = ?, link = ?, request_time = now()',
            [$new_email, $current_email, $_SESSION['changeemail_link']]);
    }

    public function changeEmail(string $link): bool
    {
        if ($new_email = $this->db->dbQuery("SELECT * FROM emails_changes WHERE link = ?", [$link])) {
            $this->db->dbQuery("UPDATE users SET updated_at = now(), email = ? WHERE id = ?",
                [$new_email[0]['new_email'], $_SESSION['user']['id']]);

            return true;
        } else {
            return false;
        }
    }
}