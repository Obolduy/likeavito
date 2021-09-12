<?php
namespace App\Models;

use App\Models\Interfaces\iDatabase;

class Pagination
{
    public $table;
    public $pageCount;
    private $tableName;
    private $columnName;
    private $property;
    private $border1;
    private $border2;
    private $count;
    private $db;

    public function __construct(string $tableName, int $border1, int $border2 = 5, iDatabase $db = null)
    {
        $this->tableName = $tableName;
        $this->border1 = $border1;
        $this->border2 = $border2;
        $this->db = $db ?? DEFAULT_DB_CONNECTION;
    }

    public function pagination(string $columnName = null, string $property = null)
    {
        if ($columnName !== null && $property !== null) {
            $this->columnName = $columnName;
            $this->property = $property;
            $this->table = $this->getTable();
        } else {
            $this->table = $this->getWholeTable();
        }
        $this->pageCount = $this->getPageCount();
    }

    private function getWholeTable(): array
    {   
        return $this->db->dbQuery("SELECT * FROM ? LIMIT ?, ?",
                [$this->tableName, $this->border1, $this->border2])
                    ->fetchAll();
    }

    private function getTable(): array
    {   
        return $this->db->dbQuery("SELECT * FROM ? WHERE ? = ? LIMIT ?, ?",
                [$this->tableName, $this->columnName, $this->property, $this->border1, $this->border2])
                    ->fetchAll();
    }

    private function getPageCount()
    {
        $this->count = $this->db->dbQuery("SELECT COUNT(*) FROM ? WHERE ? = ?",
            [$this->tableName, $this->columnName, $this->property])->fetchColumn();
        
        while ($this->count % 5 != 0) {
            $this->count++;
        }

        return $this->count / 5;
    }
}