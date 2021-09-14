<?php
namespace App\Models;

use App\Models\Database;

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

    public function __construct(string $tableName, int $border1, int $border2 = 5)
    {
        $this->tableName = $tableName;
        $this->border1 = $border1;
        $this->border2 = $border2;
        $this->db = new Database();
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
        return $this->db->dbQuery("SELECT * FROM {$this->tableName} LIMIT {$this->border1}, {$this->border2}")
                ->fetchAll();
    }

    private function getTable(): array
    {   
        return $this->db->dbQuery("SELECT * FROM {$this->tableName} WHERE {$this->columnName} = ? LIMIT {$this->border1}, {$this->border2}",
                [$this->property])->fetchAll();
    }

    private function getPageCount()
    {
        $this->count = $this->db->dbQuery("SELECT COUNT(*) FROM {$this->tableName} WHERE {$this->columnName} = ?",
            [$this->property])->fetchColumn();
        
        while ($this->count % 5 != 0) {
            $this->count++;
        }

        return $this->count / 5;
    }
}