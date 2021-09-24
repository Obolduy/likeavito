<?php
use PHPUnit\Framework\TestCase;
use App\Models\LotManipulate;
use App\Models\Database;

class LotManipulateTest extends TestCase
{
    private $lotManipulate, $database;

    protected function setUp(): void 
    {
        $this->lotManipulate = new LotManipulate();
        $this->database = new Database();
    }

    public function addLotProvider()
    {
        return [
            ['TestTitle1', 100, 'Description1', 1, 49],
            ['TestTitle2', 1000, 'Description2', 2, 69],
            ['TestTitle3', 101, 'Description3', 3, 1],
            ['TestTitle4', 200, 'Description4', 4, 65],
        ];
    }

    public function changeLotProvider()
    {
        return [
            [55, 'TestChangeTitle1', 200, 'TestDescription1', 2, 0, null],
            [56, 'TestChangeTitle2', 2000, 'TestDescription2', 3, 0, null],
            [57, 'TestChangeTitle3', 202, 'TestDescription3', 4, 0, null],
            [58, 'TestChangeTitle4', 300, 'TestDescription4', 5, 0, null]
        ];
    }

    public function deleteLotProvider()
    {
        return [
            [55],
            [56],
            [57],
            [58]
        ];
    }

    /**
     * @dataProvider addLotProvider
     */

    public function testAddLot($title, $price, $description, $categoryId, $ownerId)
    {
        $this->lotManipulate->addLot($title, $price, $description, $categoryId, $ownerId);

        $test = $this->database->dbQuery('SELECT * FROM lots WHERE title = ? AND description = ?',
            [$title, $description])->fetch();

        $this->assertEquals($title, $test['title']);
        $this->assertEquals($price, $test['price']);
        $this->assertEquals($description, $test['description']);
        $this->assertEquals($categoryId, $test['category_id']);
        $this->assertEquals($ownerId, $test['owner_id']);
    }

    /**
     * @dataProvider changeLotProvider
     */

    public function testChangeLot($lotId, $title, $price, $description, $categoryId, $display, $photo)
    {
        $this->lotManipulate->changeLot($lotId, $title, $price, $description, $categoryId, $display, $photo);

        $test = $this->database->dbQuery('SELECT * FROM lots WHERE id = ?',
            [$lotId])->fetch();

        $this->assertEquals($title, $test['title']);
        $this->assertEquals($price, $test['price']);
        $this->assertEquals($description, $test['description']);
        $this->assertEquals($categoryId, $test['category_id']);
        $this->assertEquals($display, $test['display']);
    }

    /**
     * @dataProvider deleteLotProvider
     */

    public function testDeleteLot($lotId)
    {
        $this->lotManipulate->deleteLot($lotId);

        $test = $this->database->dbQuery('SELECT * FROM lots WHERE id = ?',
            [$lotId])->fetch();

        $this->assertFalse($test);
    }

    protected function tearDown(): void
    {
        $this->lotManipulate = NULL;
        $this->database = NULL;
    }
}