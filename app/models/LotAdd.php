<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class LotAdd
{
    private $title;
    private $price;
    private $description;
    private $categoryId;
    private $ownerId;
    private $db;

    public function __construct(string $title, int $price, string $description, int $categoryId, int $ownerId, iDatabase $db = null)
    {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->categoryId = $categoryId;
        $this->ownerId = $ownerId;
        $this->db = $db ?? DEFAULT_DB_CONNECTION;

        $this->addLot();
    }

    private function addLot(): void
    {
        $this->db->dbQuery("INSERT INTO lots SET owner_id = ?, category_id = ?, title = ?, price = ?, 
            description = ?, add_time = NOW(), update_time = NOW()",
                [$this->ownerId, $this->categoryId, $this->title, $this->price, $this->description]);
    }
}