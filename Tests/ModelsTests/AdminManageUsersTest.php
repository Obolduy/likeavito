<?php
use PHPUnit\Framework\TestCase;
use App\Models\AdminManageUsers;
use App\Models\UserGet;

class AdminManageUsersTest extends TestCase
{
    private $adminManageUsers, $userGet;

    protected function setUp(): void 
    {
        $this->adminManageUsers = new AdminManageUsers();
        $this->userGet = new UserGet();
    }

    public function userChangeByAdminProvider()
    {
        return [
            [66, 'login23', 'email23@what.com', 'Name23', 'surname23', 2],
            [67, 'login33', 'email33@what.com', 'Name33', 'surname33', 3],
            [68, 'login43', 'email43@what.com', 'Name43', 'surname43', 4],
            [69, 'login53', 'email53@what.com', 'Name53', 'surname53', 5],
        ];
    }

    public function userBanManageProvider()
    {
        return [
            [1, 68],
            [0, 69],
            [0, 66],
            [1, 70]
        ];
    }

    public function userAdminManageProvider()
    {
        return [
            [1, 68],
            [2, 69],
            [2, 66],
            [1, 70]
        ];
    }

    public function testUserChangeByAdmin(int $userId, string $login, string $email, string $name, string $surname, int $cityId)
    {
        $this->adminManageUsers->userChangeByAdmin($userId, $login, $email, $name, $surname, $cityId);

        $test = $this->userGet->getUserInfo($userId);

        $this->assertEquals($login, $test['login']);
        $this->assertEquals($login, $test['email']);
        $this->assertEquals($login, $test['name']);
        $this->assertEquals($login, $test['surname']);
        $this->assertEquals($login, $test['city_id']);
    }

    /**
     * @dataProvider userBanManageProvider
     */

    public function testUserBanManage(int $banStatus, int $userId)
    {
        $this->adminManageUsers->userBanManage($userId, $banStatus);

        $test = $this->userGet->getUserInfo($userId);
        $this->assertEquals($banStatus, $test['ban_status']);
    }

    /**
     * @dataProvider userAdminManageProvider
     */

    public function testUserAdminManage(int $adminStatus, int $userId)
    {
        $this->adminManageUsers->userAdminManage($userId, $adminStatus);

        $test = $this->userGet->getUserInfo($userId);
        $this->assertEquals($adminStatus, $test['status_id']);
    }
    
    protected function tearDown(): void
    {
        $this->adminManageUsers = NULL;
        $this->userGet = NULL;
    }
}