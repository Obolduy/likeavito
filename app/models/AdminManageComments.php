<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class AdminManageComments
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function hideComment(int $commentId): void
    {
        $this->db->dbQuery("UPDATE comments SET display = 0 WHERE id = ?", [$commentId]);
    }

    public function unhideComment(int $commentId): void
    {
        $this->db->dbQuery("UPDATE comments SET display = 1 WHERE id = ?", [$commentId]);
    }
}