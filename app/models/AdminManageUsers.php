<?php
namespace App\Models;

class AdminManageUsers extends Model
{
    public function userChangeByAdmin(int $userId, string $login, string $email, string $name, string $surname, int $cityId): void
    {
        $this->db->transaction([
            ["UPDATE users SET login = ?, email = ?, city_id = ?, updated_at = now() WHERE id = ?", [$login, $email, $cityId, $userId]],
            ["UPDATE names SET name = ? WHERE user_id = ?", [$name, $userId]],
            ["UPDATE surnames SET surname = ? WHERE user_id = ?", [$surname, $userId]]
        ]);
    }

    public function userBanManage(int $userId, int $banStatus): void
    {
        $this->db->dbQuery("UPDATE users SET ban_status = ? WHERE id = ?", [$banStatus, $userId]);
    }

    public function userAdminManage(int $userId, int $adminStatus): void
    {
        $this->db->dbQuery("UPDATE users SET status_id = ? WHERE id = ?", [$adminStatus, $userId]);
    }
}