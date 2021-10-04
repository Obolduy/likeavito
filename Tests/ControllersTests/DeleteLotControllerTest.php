<?php
use PHPUnit\Framework\TestCase;
use App\Models\LotGet;
use App\Controllers\DeleteLotController;

class DeleteLotControllerTest extends TestCase
{
    private $deleteLotController, $lotGet;

    protected function setUp(): void 
    {
        $this->deleteLotController = new DeleteLotController();
        $this->lotGet = new LotGet();
    }

    public function deleteLotProvider()
    {
        return [
            [22],
            [23],
            [24],
            [25]
        ];
    }

    /**
     * @dataProvider deleteLotProvider
     */

    public function testDeleteLot($lotId) 
    {
        $this->deleteLotController->deleteLot($lotId);

        $data = $this->lotGet->getFullLotInfo($lotId);

        $this->assertFalse($data);
    }

    protected function tearDown(): void
    {
        $this->deleteLotController = null;
        $this->lotGet = null;
    }
}