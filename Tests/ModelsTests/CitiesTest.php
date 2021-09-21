<?php
use PHPUnit\Framework\TestCase;
use App\Models\Cities;

class CitiesTest extends TestCase
{
    private $cities;

    protected function setUp(): void 
    {
        $this->cities = new Cities();
    }

    public function testGetAllCities()
    {
        $test = $this->cities->getAllCities();

        foreach ($test as $elem) {
            $this->assertNotNull($elem);
        }
    }

    protected function tearDown(): void
    {
        $this->cities = NULL;
    }
}