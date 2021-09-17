<?php
namespace App\Models;

class Categories extends Model
{
    public function addCategory(int $categoryName): void
    {
        $this->db->dbQuery("INSERT INTO lots_category SET category = ?", [$categoryName]);
    }

    public function getAllCategories(): array
    {
        return $this->db->dbQuery("SELECT * FROM lots_category")->fetchAll();
    }

    public function getCategory(int $categoryId): array
    {
        return $this->db->dbQuery("SELECT * FROM lots_category WHERE id = ?", [$categoryId])->fetch();
    }

    public function changeCategory(int $categoryId, string $categoryName): void
    {
        $this->db->dbQuery("UPDATE lots_category SET category = ? WHERE id = ?", [$categoryName, $categoryId]);
    }

    public function deleteCategory(int $categoryId): void
    {
        $this->db->dbQuery("DELETE FROM lots_category WHERE id = ?", [$categoryId]);
    }
}