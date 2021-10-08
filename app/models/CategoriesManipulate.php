<?php
namespace App\Models;

class CategoriesManipulate extends Model
{
    public function addCategory(string $categoryName): void
    {
        $this->db->dbQuery("INSERT INTO lots_category SET category = ?", [$categoryName]);
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