<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\AdminChangeCityController;
use App\Models\CitiesGet;

class AdminChangeCityControllerTest extends TestCase
{
    private $adminChangeCityController, $city;

    protected function setUp(): void 
    {
        $this->adminChangeCityController = new AdminChangeCityController();
        $this->city = new CitiesGet();
    }

    public function changeCityProvider()
    {
        return [
            [10, 'NewCity01'],
            [11, 'NewCity02'],
            [12, 'NewCity03'],
            [13, 'NewCity04']
        ];
    }

    /**
     * @dataProvider changeCityProvider
     */

    public function testAdminChangeCityController($city_id, $title) 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['city'] = $title;

        $this->adminChangeCityController->adminChangeCity($city_id);

        $data = $this->city->getCity($city_id);

        $this->assertEquals($title, $data['city']);
    }

    protected function tearDown(): void
    {
        $this->adminChangeCityController = NULL;
        $this->city = NULL;
    }
}