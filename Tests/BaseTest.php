<?php
use PHPUnit\Framework\TestCase;
require 'Base.php';

class BaseTest extends TestCase
{
    private $base;

    protected function setUp(): void 
    {
        $this->base = new Base();
    }

    public function testSelectQuery() 
    {
        $info = $this->base->selectQuery('SELECT * FROM categories WHERE id = 10');

        foreach($info as $elem) {
            $result1 = $elem['category'];
            $result2 = $elem['id'];
        }

        $this->assertEquals('Категория 10', $result1);
        $this->assertEquals(10, $result2);

        $info = $this->base->selectQuery('SELECT id FROM categories WHERE id = 8');

        foreach($info as $elem) {
            $result3 = $elem['id'];
        }

        $this->assertEquals(8, $result3);
    }

    public function testGetAll() 
    {
        $info = $this->base->getAll('categories');

        foreach($info as $elem) {
            $result1 = $elem['category'];
            $result2 = $elem['id'];
        }

        $this->assertEquals('Категория 1', $result1);
        $this->assertEquals(1, $result2);
    }

    public function testGetOne() 
    {
        $info = $this->base->getOne('categories', 5);

        foreach($info as $elem) {
            $result1 = $elem['category'];
            $result2 = $elem['id'];
        }

        $this->assertEquals('Категория 5', $result1);
        $this->assertEquals(5, $result2);

        $info = $this->base->getOne('categories', 'Категория 4', 'category');

        foreach($info as $elem) {
            $result3 = $elem['category'];
            $result4 = $elem['id'];
        }

        $this->assertEquals('Категория 4', $result3);
        $this->assertEquals(4, $result4);
    }

    public function testDelete() 
    {
        $delete = $this->base->delete('categories', 12);

        $info = $this->base->getOne('categories', 12);

        foreach($info as $elem) {
            $result = $elem['id'];
        }

        $this->assertNotEquals(12, $result);
    }

    public function testUpdateQuery() 
    {
        $update = $this->base->updateQuery("UPDATE users SET name_id = ?, surname_id = ? WHERE id = ?", [1, 1, 1]);

        $info = $this->base->getOne('users', 1);

        foreach($info as $elem) {
            $result1 = $elem['name_id'];
            $result2 = $elem['surname_id'];
        }

        $this->assertEquals(1, $result1);
        $this->assertEquals(1, $result2);
    }

    protected function tearDown(): void
    {
        $this->base = NULL;
    }
    /** TODO:
     * Test all methods of Base.php when DB and views will be ready.
     */
}