<?php

use PHPUnit\Framework\TestCase;
use App\Models\CitiesGet;
use App\Controllers\AdminDeleteCityController;

class AdminDeleteCityControllerTest extends TestCase
{
    private $adminDeleteCityController, $city;

    protected function setUp(): void 
    {
        $this->adminDeleteCityController = new AdminDeleteCityController();
        $this->city = new CitiesGet();
    }

    public function adminDeleteCityProvider()
    {
        return [
            [3],
            [4],
            [5],
            [6]
        ];
    }

    /**
     * @dataProvider adminDeleteCityProvider
     * headers already sent by phpunit
     */

    public function testAdminDeleteCity($city_id) 
    {
        $this->adminDeleteCityController->adminDeleteCity($city_id);

        $this->assertNull($this->city->getCity($city_id));
    }

    protected function tearDown(): void
    {
        $this->adminDeleteCityController = NULL;
        $this->city = NULL;
    }
}