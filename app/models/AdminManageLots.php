<?php
namespace App\Models;

class AdminManageLots extends Model
{
    public function manageDisplayLot(int $display, int $lotId): void
    {
        $this->db->dbQuery("UPDATE lots SET display = ? WHERE id = ?", [$display, $lotId]);
    }
}