<?php

use PHPUnit\Framework\TestCase;
use App\Models\Database;
use App\Controllers\AdminDeleteLotController;

class AdminDeleteLotControllerTest extends TestCase
{
    private $adminDeleteLotController, $database;

    protected function setUp(): void 
    {
        $this->adminDeleteLotController = new AdminDeleteLotController();
        $this->database = new Database();
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

        $this->assertFalse($this->database->dbQuery("SELECT * FROM lots WHERE id = ?", [$lot_id]));
        $this->assertFalse($this->database->dbQuery("SELECT * FROM lots_pictures WHERE lot_id = ?", [$lot_id]));
    }

    protected function tearDown(): void
    {
        $this->adminDeleteLotController = NULL;
        $this->database = NULL;
    }
}