<?php
use PHPUnit\Framework\TestCase;
use App\Models\LotGet;

class LotGetTest extends TestCase
{
    private $lotGet;

    protected function setUp(): void 
    {
        $this->lotGet = new LotGet();
    }

    public function getFullLotInfoProvider()
    {
        return [
            [30, ['LotInfo' => ['id' => 30, 'login' => 'guerngwrjg8s'], 'LotPictures' => ['lot_id' => 30]]],
            [42, ['LotInfo' => ['id' => 42, 'login' => 'Durachok']]]
        ];
    }

    public function getUserLotsProvider()
    {
        return [
            [10, ['id' => 30, 'title' => 'newAdd5']],
            [49, ['id' => 39, 'title' => 'fdsfsdf']]
        ];
    }

    /**
     * @dataProvider getFullLotInfoProvider
     */

    public function testGetFullLotInfo($lotId, $expected)
    {
        $test = $this->lotGet->getFullLotInfo($lotId);

        $this->assertEquals($expected['LotInfo']['id'], $test['LotInfo']['id']);
        $this->assertEquals($expected['LotInfo']['login'], $test['LotInfo']['login']);

        if ($lotId == 30) {
            foreach ($test['LotPictures'] as $elem) {
                $this->assertEquals($expected['LotPictures']['lot_id'], $elem['lot_id']);
            }
        }
    }

    /**
     * @dataProvider getUserLotsProvider
     */

    public function testGetUserLots($userId, $expected)
    {
        $test = $this->lotGet->getUserLots($userId);
        
        $this->assertEquals($expected['id'], $test[0]['id']);
        $this->assertEquals($expected['title'], $test[0]['title']);
    }

    protected function tearDown(): void
    {
        $this->lotGet = NULL;
    }
}