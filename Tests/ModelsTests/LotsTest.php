<?php
use PHPUnit\Framework\TestCase;
use App\Models\Lots;

class LotsTest extends TestCase
{
    private $lot;

    protected function setUp(): void 
    {
        $this->lot = new Lots();
    }

    public function addLotProvider()
    {
        return [
            ['Title1', 10050, 'Description1', 5, 20, 22],
            ['Title2', 1254, 'Description2', 7, 21, 23],
            ['Title3', 1200, 'Description3', 1, 22, 24],
            ['Title4', 1000, 'Description4', 2, 23, 25]
        ];
    }

    public function addLotPictureProvider()
    {
        return [
            [22, 'photo1', 1],
            [23, 'photo2', 2],
            [24, 'photo3', 3],
            [25, 'photo4', 4]
        ];
    }

    /**
     * @dataProvider addLotProvider
     */

    public function testAddLot($title, $price, $description, $category_id, $owner_id, $expected) 
    {
        $this->lot->addLot($title, $price, $description, $category_id, $owner_id);

        $data = $this->lot->getOne('lots', $owner_id, 'owner_id');

        foreach ($data as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider addLotPictureProvider
     */

    public function testAddLotPictures($lot_id, $picture, $expected) 
    {
        $this->lot->addLotPictures($picture, $lot_id);

        $data = $this->lot->getOne('lots_pictures', $lot_id, 'lot_id');

        foreach ($data as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    protected function tearDown(): void
    {
        $this->lot = NULL;
    }
}