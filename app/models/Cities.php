<?php
namespace App\Models;

class Cities extends Model
{
    public function getAllCities(): array
    {
        return $this->db->dbQuery("SELECT * FROM cities")->fetchAll();
    }
}