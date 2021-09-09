<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class GetUser
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function getUserByKey(array $data): array
    {
        return $this->db->dbQuery("SELECT * FROM users WHERE ? = ?",
            [array_keys($data), array_values($data)])->fetch();
    }
}