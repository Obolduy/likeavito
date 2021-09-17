<?php
use PHPUnit\Framework\TestCase;
use App\Models\Lots;
use App\Controllers\AdminChangeLotController;

class AdminChangeLotControllerTest extends TestCase
{
    private $adminChangeLotController;
    private $lot;

    protected function setUp(): void 
    {
        $this->adminChangeLotController = new AdminChangeLotController();
        $this->lot = new Lots();
    }

    public function changeLotProvider()
    {
        return [
            [26, 'title00001', 5000, 'NewDescription001', 1],
            [27, 'title00002', 845, 'NewDescription002', 4],
            [28, 'title00003', 848, 'NewDescription003', 8],
            [29, 'title00004', 848, 'NewDescription004', 6]
        ];
    }

    /**
     * @dataProvider changeLotProvider
     */

    public function testAdminChangeLot($lot_id, $title, $price, $description, $category_id) 
    {
        $_POST['title'] = $title;
        $_POST['price'] = $price;
        $_POST['description'] = $description;
        $_POST['category_id'] = $category_id;

        $this->adminChangeLotController->adminChangeLot($lot_id);

        $data = $this->lot->getOne('lots', $description, 'description');

        foreach ($data as $elem) {
            $this->assertEquals($description, $elem['description']);
        }
    }

    protected function tearDown(): void
    {
        $this->adminChangeLotController = NULL;
        $this->lot = NULL;
    }
}