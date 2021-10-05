<?php
namespace App\Models;

class Pagination extends Model
{
    public $table, $pageCount;
    private $border1, $border2, $count, $query;

    public function __construct(int $border1, int $border2 = 5)
    {
        parent::__construct();
        $this->border1 = $border1;
        $this->border2 = $border2;
    }

    public function pagination(string $query)
    {
        $this->query = $query;

        $this->pageCount = $this->getPageCount();

        $this->table = $this->db->dbQuery("$query LIMIT {$this->border1}, {$this->border2}")->fetchAll();
    }

    private function getPageCount()
    {
        $this->count = count($this->db->dbQuery($this->query)->fetchAll());

        while ($this->count % $this->border2 != 0) {
            $this->count++;
        }

        return $this->count /= $this->border2;
    }
}