<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class Cities
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function getAllCities(): array
    {
        return $this->db->dbQuery("SELECT * FROM cities")->fetchAll();
    }
}