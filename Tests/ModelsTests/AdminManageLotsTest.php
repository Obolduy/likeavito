<?php
use PHPUnit\Framework\TestCase;
use App\Models\AdminManageLots;
use App\Models\LotGet;

class AdminManageLotsTest extends TestCase
{
    private $adminManageLots;
    private $lotGet;

    protected function setUp(): void 
    {
        $this->adminManageLots = new AdminManageLots();
        $this->lotGet = new LotGet();
    }

    public function hideUnhideLotProvider()
    {
        return [
            [39],
            [40],
            [41],
            [42]
        ];
    }

    /**
     * @dataProvider hideUnhideLotProvider
     */

    public function testHideLot(int $lotId)
    {
        $this->adminManageLots->hideLot($lotId);

        $test = $this->lotGet->getFullLotInfo($lotId);
        $this->assertEquals(0, $test['LotInfo']['display']);
    }

    /**
     * @dataProvider hideUnhideLotProvider
     */

    public function testUnhideLot(int $lotId)
    {
        $this->adminManageLots->unhideLot($lotId);

        $test = $this->lotGet->getFullLotInfo($lotId);
        $this->assertEquals(1, $test['LotInfo']['display']);
    }

    protected function tearDown(): void
    {
        $this->adminManageLots = NULL;
        $this->lotGet = NULL;
    }
}