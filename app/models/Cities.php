<?php
namespace App\Models;

use App\Models\Database;

class Cities
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCities(): array
    {
        return $this->db->dbQuery("SELECT * FROM cities")->fetchAll();
    }
}