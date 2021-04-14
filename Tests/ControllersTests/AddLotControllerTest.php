<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\Lots;
use App\Controllers\AddLotController;

class AddLotControllerTest extends TestCase
{
    private $addLotController;
    private $model;

    protected function setUp(): void 
    {
        $this->addLotController = new AddLotController();
        $this->model = new Model();
    }

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */

    public function testNewLot() 
    {
        $_POST['title'] = 'sdsdsdsds';
        $_POST['price'] = 48;
        $_POST['description'] = 'Description ahahah';
        $_POST['category_id'] = 1;
        $owner_id = 20;

        $this->addLotController->newLot();

        $data = $this->model->getOne('lots', 'sdsdsdsds', 'title');

        foreach($data as $elem) {
            $result = $elem['id'];
        }

        $this->assertEquals(22, $result);
    }

    protected function tearDown(): void
    {
        $this->addLotController = NULL;
        $this->model = NULL;
    }
}