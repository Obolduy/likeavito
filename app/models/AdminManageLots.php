<?php
namespace App\Models;

class AdminManageLots extends Model
{
    public function hideLot(int $lotId): void
    {
        $this->db->dbQuery("UPDATE lots SET display = 0 WHERE id = ?", [$lotId]);
    }

    public function unhideLot(int $lotId): void
    {
        $this->db->dbQuery("UPDATE lots SET display = 1 WHERE id = ?", [$lotId]);
    }
}