<?php
namespace App\Models;
use App\Models\Interfaces\iDatabase;

class Pagination
{
    private $categoryId;
    private $categoryCount;
    private $pageCount;
    private $db;

    public function __construct(int $categoryId, iDatabase $db = null)
    {
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
        $this->categoryId = $categoryId;
    }

    public function pagination()
    {
        $this->categoryCount = $this->db->dbQuery("SELECT COUNT(*) FROM lots WHERE category_id = ?",
            [$this->categoryId])->fetchAll();
        
        while ($this->categoryCount[0][0] % 5 != 0) {
            $this->categoryCount[0][0]++;
        }

        $this->pageCount = $this->categoryCount[0][0] / 5;

        return $this->pageCount;
    }
}