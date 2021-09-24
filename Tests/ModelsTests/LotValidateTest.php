<?php
use PHPUnit\Framework\TestCase;
use App\Models\LotValidate;

class LotValidateTest extends TestCase
{
    private $lotValidate;

    protected function setUp(): void 
    {
        $this->lotValidate = new LotValidate();
    }

    public function checkLotDataProvider()
    {
        return [
            ['TestTitle', 457, true],
            [43, 342, ['Название должно быть записано текстом']],
            ['fddf', 'fdfd', ['Цена должна быть записана корректным числом']],
            [4324, 'fdfdsfs', ['Название должно быть записано текстом', 'Цена должна быть записана корректным числом']]
        ];
    }

    /**
     * @dataProvider checkLotDataProvider
     */

    public function testCheckLotData($title, $price, $expected)
    {
        $test = $this->lotValidate->checkLotData($title, $price);
        $this->assertEquals($expected, $test);
    }

    protected function tearDown(): void
    {
        $this->lotValidate = NULL;
    }
}