<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\AdminAddCityController;
use App\Models\CitiesGet;

class AdminAddCityControllerTest extends TestCase
{
    private $adminAddCityController, $city;

    protected function setUp(): void 
    {
        $this->adminAddCityController = new AdminAddCityController();
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

    public function testAddCityController($city) 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['city'] = $city;

        $this->adminAddCityController->addCity();

        $data = $this->city->getAllCities();

        foreach ($data as $elem) {
            if (in_array($city, $elem['city'])) {
                $check = true;
            }
        }
        
        $this->assertTrue($check);
    }

    protected function tearDown(): void
    {
        $this->adminAddCityController = NULL;
        $this->city = NULL;
    }
}