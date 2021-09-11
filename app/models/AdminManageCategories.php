<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class AdminManageCategories
{
    private $db;

    public function __construct(iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function addCategory(int $categoryName): void
    {
        $this->db->dbQuery("INSERT INTO lots_category SET category = ?", [$categoryName]);
    }

    public function getAllCategories(): array
    {
        return $this->db->dbQuery("SELECT * FROM lots_category")->fetchAll();
    }

    public function changeCategory(int $categoryId, $categoryName): void
    {
        $this->db->dbQuery("UPDATE lots_category SET category = ? WHERE id = ?", [$categoryName, $categoryId]);
    }

    public function deleteCategory(int $categoryId): void
    {
        $this->db->dbQuery("DELETE FROM lots_category WHERE id = ?", [$categoryId]);
    }
}