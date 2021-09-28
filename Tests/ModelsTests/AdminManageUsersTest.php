<?php
use PHPUnit\Framework\TestCase;
use App\Models\AdminManageUsers;
use App\Models\UserGet;

class AdminManageUsersTest extends TestCase
{
    private $adminManageUsers;
    private $userGet;

    protected function setUp(): void 
    {
        $this->adminManageUsers = new AdminManageUsers();
        $this->userGet = new UserGet();
    }

    public function manageUsersProvider()
    {
        return [
            [66, 1],
            [67, 1],
            [66, 0],
            [67, 0]
        ];
    }

    public function adminUndoProvider()
    {
        return [
            [66, 55],
            [67, 55],
            [66, 66],
            [67, 66]
        ];
    }

    /**
     * @dataProvider manageUsersProvider
     */

    public function testUserBanManage(int $userId, int $banStatus)
    {
        $this->adminManageUsers->userBanManage($userId, $banStatus);

        $test = $this->userGet->getUserInfo($userId);
        $this->assertEquals($banStatus, $test['ban_status']);
    }

    /**
     * @dataProvider manageUsersProvider
     */

    public function testMakeUserAnAdmin(int $userId, int $banStatus)
    {
        $this->adminManageUsers->makeUserAnAdmin($userId);

        $test = $this->userGet->getUserInfo($userId);
        $this->assertEquals(2, $test['status_id']);
    }

    /**
     * @dataProvider adminUndoProvider
     */

    public function testUndoUserAsAnAdmin(int $userId, int $sessionId)
    {
        $_SESSION['user']['id'] = $sessionId;
        
        $test = $this->adminManageUsers->undoUserAsAnAdmin($userId);

        if ($sessionId == $userId) {
            $this->assertFalse($test);
        } else {
            $this->assertTrue($test);
        }
    }

    protected function tearDown(): void
    {
        $this->adminManageUsers = NULL;
        $this->userGet = NULL;
    }
}