<?php
use PHPUnit\Framework\TestCase;
require 'Base.php';

class BaseTest extends TestCase
{
    private $base;

    protected function setUp(): void {
        $this->base = new Base();
    }

    public function testGetAll() {
        $info = $this->base->getAll('categories');

        foreach($info as $elem) {
            $result1 = $elem['category'];
            $result2 = $elem['id'];
        }
        $this->assertEquals('Категория 1', $result1);
        $this->assertEquals(1, $result2);
    }

    protected function tearDown(): void
    {
        $this->base = NULL;
    }
}