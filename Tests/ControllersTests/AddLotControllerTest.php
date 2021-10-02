<?php
use PHPUnit\Framework\TestCase;
use App\Models\LotGet;
use App\Controllers\AddLotController;

class AddLotControllerTest extends TestCase
{
    private $addLotController, $lotGet;

    protected function setUp(): void 
    {
        $this->addLotController = new AddLotController();
        $this->lotGet = new LotGet();
    }

    public function newLotProvider()
    {
        return [
            ['NewLot1', 50, 'newdesc1', 1, 77, 77],
            ['NewLot2', 100, 'newdesc2', 5, 78, 78],
            ['NewLot3', 30, 'newdesc3', 4, 79, 79],
            ['NewLot4', 60, 'newdesc4', 6, 80, 80]
        ];
    }

    /**
     * @dataProvider newLotProvider
     */

    public function testNewLot($title, $price, $description, $categoryId, $ownerId, $lotId) 
    {
        $_POST['title'] = $title;
        $_POST['price'] = $price;
        $_POST['description'] = $description;
        $_POST['category_id'] = $categoryId;
        $_SESSION['user']['id'] = $ownerId;
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $this->addLotController->newLot();

        $test = $this->lotGet->getFullLotInfo($lotId);

        $this->assertIsArray($test);
    }

    protected function tearDown(): void
    {
        $this->addLotController = NULL;
        $this->lotGet = NULL;
    }
}