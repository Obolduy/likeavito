<?php
namespace App\Models;

class CitiesGet extends Model
{
    public function getAllCities(): array
    {
        return $this->db->dbQuery("SELECT * FROM cities")->fetchAll();
    }

    public function getCity(int $cityId): array
    {
        return $this->db->dbQuery("SELECT * FROM cities WHERE id = ?", [$cityId])->fetch();
    }
}