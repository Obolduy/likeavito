<?php
use PHPUnit\Framework\TestCase;
use App\Models\Lots;
use App\Controllers\AdminDeleteLotController;

class AdminDeleteLotControllerTest extends TestCase
{
    private $adminDeleteLotController;
    private $lot;

    protected function setUp(): void 
    {
        $this->adminDeleteLotController = new AdminDeleteLotController();
        $this->lot = new Lots();
    }

    public function adminDeleteLotProvider()
    {
        return [
            [26],
            [27],
            [28],
            [29]
        ];
    }

    /**
     * @dataProvider adminDeleteLotProvider
     * headers already sent by phpunit
     */

    public function testAdminDeleteLot($lot_id) 
    {
        $this->adminDeleteLotController->adminDeleteLot($lot_id);

        $this->assertNull($this->lot->getOne('lots', $lot_id)[0]);
        $this->assertNull($this->lot->getOne('lots_pictures', $lot_id, 'lot_id')[0]);
    }

    protected function tearDown(): void
    {
        $this->adminDeleteLotController = NULL;
        $this->lot = NULL;
    }
}