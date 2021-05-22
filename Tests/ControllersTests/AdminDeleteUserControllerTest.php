<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Controllers\AdminDeleteUserController;

class AdminDeleteUserControllerTest extends TestCase
{
    private $adminDeleteUserController;
    private $user;

    protected function setUp(): void 
    {
        $this->adminDeleteUserController = new AdminDeleteUserController();
        $this->user = new User();
    }

    public function adminDeleteUserProvider()
    {
        return [
            [3],
            [4],
            [5],
            [6]
        ];
    }

    /**
     * @dataProvider adminDeleteUserProvider
     * headers already sent by phpunit
     */

    public function testAdminDeleteUser($user_id) 
    {
        $this->adminDeleteUserController->adminDeleteUser($user_id);

        $this->assertNull($this->user->getOne('users', $user_id)[0]);
    }

    protected function tearDown(): void
    {
        $this->adminDeleteUserController = NULL;
        $this->user = NULL;
    }
}