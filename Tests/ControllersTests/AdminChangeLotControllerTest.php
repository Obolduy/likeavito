<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\AdminChangeLotController;
use App\Models\Database;

class AdminChangeLotControllerTest extends TestCase
{
    private $adminChangeLotController, $database;

    protected function setUp(): void 
    {
        $this->adminChangeLotController = new AdminChangeLotController();
        $this->database = new Database();
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

        $data = $this->database->dbQuery("SELECT * FROM lots WHERE title = ? ORDER BY id DESC", [$title])->fetch();

        $this->assertIsArray($data);
    }

    protected function tearDown(): void
    {
        $this->adminChangeLotController = NULL;
        $this->lot = NULL;
    }
}