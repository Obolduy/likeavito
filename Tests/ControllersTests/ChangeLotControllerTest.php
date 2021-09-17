<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\Lots;
use App\Controllers\ChangeLotController;

class ChangeLotControllerTest extends TestCase
{
    private $changeLotController;
    private $model;
    private $lot;

    protected function setUp(): void 
    {
        $this->changeLotController = new ChangeLotController();
        $this->model = new Model();
        $this->lot = new Lots();
    }

    public function changeLotProvider()
    {
        return [
            ['NewTitle1', 'NewDesc1', 1500, 22, 'NewTitle1'],
            ['NewTitle2', 'NewDesc2', 2000, 23, 'NewTitle2'],
            ['NewTitle3', 'NewDesc3', 300, 24, 'NewTitle3'],
            ['NewTitle4', 'NewDesc4', 450, 25, 'NewTitle4']
        ];
    }

    /**
     * @dataProvider changeLotProvider
     */

    public function testChangeLot($title, $description, $price, $lot_id, $expected) 
    {
        $_POST['title'] = $title;
        $_POST['description'] = $description;
        $_POST['price'] = $price;

        $this->changeLotController->changeLot($lot_id);

        $data = $this->model->getOne('lots', $title, 'title');

        foreach($data as $elem) {
            $this->assertEquals($expected, $elem['title']);
        }
    }

    protected function tearDown(): void
    {
        $this->changeLotController = NULL;
        $this->model = NULL;
        $this->lot = NULL;
    }
}