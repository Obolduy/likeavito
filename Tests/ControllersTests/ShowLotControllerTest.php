<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\Lots;
use App\Controllers\ShowLotController;

class ShowLotControllerTest extends TestCase
{
    private $showLotController;
    private $model;
    private $lot;

    protected function setUp(): void 
    {
        $this->showLotController = new ShowLotController();
        $this->model = new Model();
        $this->lot = new Lots();
    }

    public function testShowLot() 
    {
        $this->showLotController->showLot(1, 10);

        $data = $this->model->getOne('lots', 10);

        foreach($data as $elem) {
            $this->assertNotNull($elem['id']);
        }

    }

    protected function tearDown(): void
    {
        $this->showLotController = NULL;
        $this->model = NULL;
        $this->lot = NULL;
    }
}