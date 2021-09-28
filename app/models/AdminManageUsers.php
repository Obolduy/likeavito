<?php
namespace App\Models;

class AdminManageUsers extends Model
{
    public function userBanManage(int $userId, int $banStatus): void
    {
        $this->db->dbQuery("UPDATE users SET ban_status = ? WHERE id = ?", [$banStatus, $userId]);
    }

    public function makeUserAnAdmin(int $userId): void
    {
        $this->db->dbQuery("UPDATE users SET status_id = 2 WHERE id = ?", [$userId]);
    }

    public function undoUserAsAnAdmin(int $userId): bool
    {
        if ($userId != $_SESSION['user']['id']) {
            $this->db->dbQuery("UPDATE users SET status_id = 1 WHERE id = ?", [$userId]);

            return true;
        } else {
            return false;
        }
    }
}