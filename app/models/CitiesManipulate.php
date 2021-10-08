<?php
namespace App\Models;

class CitiesManipulate extends Model
{
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