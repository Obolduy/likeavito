<?php
namespace App\Models;

class Pagination extends Model
{
    public $table, $pageCount;
    private $tableName, $columnName, $property, $border1, $border2, $count;

    public function __construct(string $tableName, int $border1, int $border2 = 5)
    {
        parent::__construct();
        $this->tableName = $tableName;
        $this->border1 = $border1;
        $this->border2 = $border2;
    }

    public function pagination(?string $columnName = null, ?string $property = null)
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
        if ($this->columnName != null) {
            $this->count = $this->db->dbQuery("SELECT COUNT(*) FROM {$this->tableName} WHERE {$this->columnName} = ?",
                [$this->property])->fetchColumn();
        } else {
            $this->count = $this->db->dbQuery("SELECT COUNT(*) FROM {$this->tableName}")->fetchColumn();
        }

        while ($this->count % 5 != 0) {
            $this->count++;
        }

        return $this->count / 5;
    }
}