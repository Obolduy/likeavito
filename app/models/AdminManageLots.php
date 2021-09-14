<?php
namespace App\Models;

use App\Models\Database;

class AdminManageLots
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function hideLot(int $lotId): void
    {
        $this->db->dbQuery("UPDATE lots SET display = 0 WHERE id = ?", [$lotId]);
    }

    public function unhideLot(int $lotId): void
    {
        $this->db->dbQuery("UPDATE lots SET display = 1 WHERE id = ?", [$lotId]);
    }
}