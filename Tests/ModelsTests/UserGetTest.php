<?php
use PHPUnit\Framework\TestCase;
use App\Models\UserGet;

class UserGetTest extends TestCase
{
    private $userGet;

    protected function setUp(): void 
    {
        $this->userGet = new UserGet();
    }

    public function getUserInfoProvider()
    {
        return [
            [1, ['id' => 1, 'login' => 'testlogin', 'name' => 'rejc', 'surname' => 'Фдвенецатьадин', 'city' => 'Минск']],
            [50, ['id' => 50, 'login' => 'testlogin232ew', 'name' => 'testname50', 'surname' => 'testsurname50', 'city' => 'Санкт-Петербург']]
        ];
    }

    public function getUserByLoginProvider()
    {
        return [
            ['testlogin232ew'],
            ['testlogin']
        ];
    }

    public function getOtherUserProvider()
    {
        return [
            [1, ['id' => 1, 'login' => 'testlogin', 'name' => 'rejc', 'surname' => 'Фдвенецатьадин', 'city' => 'Минск']],
            [50, ['id' => 50, 'login' => 'testlogin232ew', 'name' => 'testname50', 'surname' => 'testsurname50', 'city' => 'Санкт-Петербург']]
        ];
    }

    public function testGetAllUsers()
    {
        $test = $this->userGet->getAllUsers();

        $this->assertEquals(47, count($test));
    }

    /**
     * @dataProvider getUserInfoProvider
     */

    public function testGetUserInfo(int $userId, array $expected)
    {
        $test = $this->userGet->getUserInfo($userId);

        $this->assertEquals($expected['id'], $test['id']);
        $this->assertEquals($expected['login'], $test['login']);
        $this->assertEquals($expected['name'], $test['name']);
        $this->assertEquals($expected['surname'], $test['surname']);
        $this->assertEquals($expected['city'], $test['city']);
    }

    /**
     * @dataProvider getUserByLoginProvider
     */

    public function testGetUserByLogin($login)
    {
        $test = $this->userGet->getUserByLogin($login);

        $this->assertEquals($login, $test['login']);
    }

    /**
     * @dataProvider getOtherUserProvider
     */

    public function testGetOtherUser($id, $expected)
    {
        $test = $this->userGet->getOtherUser($id);

        $this->assertEquals($expected['id'], $test['id']);
        $this->assertEquals($expected['login'], $test['login']);
        $this->assertEquals($expected['name'], $test['name']);
        $this->assertEquals($expected['surname'], $test['surname']);
        $this->assertEquals($expected['city'], $test['city']);
    }

    protected function tearDown(): void
    {
        $this->userGet = null;
    }
}