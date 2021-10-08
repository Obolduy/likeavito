<?php
namespace App\Models;

class Cities extends Model
{
    public function getAllCities(): array
    {
        return $this->db->dbQuery("SELECT * FROM cities")->fetchAll();
    }

    public function getCity(int $cityId): array
    {
        return $this->db->dbQuery("SELECT * FROM cities WHERE id = ?", [$cityId])->fetch();
    }

    public function addCity(string $cityName): void
    {
        $this->db->dbQuery("INSERT INTO cities SET city = ?", [$cityName]);
    }

    public function deleteCity(int $cityId): void
    {
        $this->db->dbQuery("DELETE FROM cities WHERE id = ?", [$cityId]);
    }

    public function changeCity(int $cityId, string $cityName): void
    {
        $this->db->dbQuery("UPDATE cities SET city = ? WHERE id = ?", [$cityName, $cityId]);
    }
}