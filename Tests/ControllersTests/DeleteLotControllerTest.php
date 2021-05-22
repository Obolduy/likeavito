<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\Lots;
use App\Controllers\DeleteLotController;

class DeleteLotControllerTest extends TestCase
{
    private $deleteLotController;
    private $model;
    private $lot;

    protected function setUp(): void 
    {
        $this->deleteLotController = new DeleteLotController();
        $this->model = new Model();
        $this->lot = new Lots();
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

    public function testDeleteLot($lot_id) 
    {
        $this->deleteLotController->deleteLot($lot_id);

        $data = $this->model->getOne('lots', $lot_id);

        foreach ($data as $elem) {
            $this->assertNull($elem);
        }

        $data = $this->model->getOne('lots_pictures', $lot_id, 'lot_id');

        foreach ($data as $elem) {
            $this->assertNull($elem);
        }
    }

    protected function tearDown(): void
    {
        $this->deleteLotController = NULL;
        $this->model = NULL;
        $this->lot = NULL;
    }
}