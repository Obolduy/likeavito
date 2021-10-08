<?php
namespace App\Models;

class CategoriesGet extends Model
{
    public function getAllCategories(): array
    {
        return $this->db->dbQuery("SELECT * FROM lots_category")->fetchAll();
    }

    public function getCategory(int $categoryId): array
    {
        return $this->db->dbQuery("SELECT * FROM lots_category WHERE id = ?", [$categoryId])->fetch();
    }
}