<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ChangeLotController;
use App\Models\Database;

class ChangeLotControllerTest extends TestCase
{
    private $changeLotController, $database;

    protected function setUp(): void 
    {
        $this->changeLotController = new ChangeLotController();
        $this->database = new Database();
    }

    public function changeLotProvider()
    {
        return [
            ['NewTitle1', 'NewDesc1', 1500, 22, 1, 'NewTitle1'],
            ['NewTitle2', 'NewDesc2', 2000, 23, null, 'NewTitle2'],
            ['NewTitle3', 'NewDesc3', 300, 24, null, 'NewTitle3'],
            ['NewTitle4', 'NewDesc4', 450, 25, 1, 'NewTitle4']
        ];
    }

    /**
     * @dataProvider changeLotProvider
     */

    public function testChangeLot($title, $description, $price, $lot_id, $display, $expected) 
    {
        $_POST['title'] = $title;
        $_POST['description'] = $description;
        $_POST['price'] = $price;
        $_POST['display'] = $display;

        $this->changeLotController->changeLot($lot_id);

        $data = $this->database->dbQuery("SELECT * FROM lots WHERE title = ? ORDER BY id DESC", [$title])->fetch();

        $this->assertIsArray($data);
    }

    protected function tearDown(): void
    {
        $this->changeLotController = NULL;
        $this->data = NULL;
    }
}