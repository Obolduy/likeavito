<?php
use PHPUnit\Framework\TestCase;
use App\Models\Pagination;

class PaginationTest extends TestCase
{
    private $pagination;

    public function paginationProvider()
    {
        return [
            ['lots', 1, 5, 'category_id', 2, ['pageCount' => 3, 'table' => 5]]
        ];
    }

    /**
     * @dataProvider paginationProvider
     */

    public function testPagination($tableName, $border1, $border2, $columnName, $property, $expected)
    {
        if ($border2 == null && $columnName == null && $property == null) {
            $this->pagination = new Pagination($tableName, $border1);
            $this->pagination->pagination();
        }
        $this->pagination = new Pagination($tableName, $border1, $border2);
        $this->pagination->pagination($columnName, $property);

        $this->assertEquals($expected['pageCount'], $this->pagination->pageCount);
        $this->assertEquals($expected['table'], count($this->pagination->table));
    }

    protected function tearDown(): void
    {
        $this->pagination = NULL;
    }
}