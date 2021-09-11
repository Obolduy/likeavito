<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class AdminManageLots
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
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