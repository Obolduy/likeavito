<?php

use PHPUnit\Framework\TestCase;
use App\Models\UserGet;
use App\Controllers\AdminDeleteUserController;

class AdminDeleteUserControllerTest extends TestCase
{
    private $adminDeleteUserController, $user;

    protected function setUp(): void 
    {
        $this->adminDeleteUserController = new AdminDeleteUserController();
        $this->user = new UserGet();
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

        $this->assertNull($this->user->getUser($user_id));
    }

    protected function tearDown(): void
    {
        $this->adminDeleteUserController = NULL;
        $this->user = NULL;
    }
}