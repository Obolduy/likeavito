<?php
use PHPUnit\Framework\TestCase;
use App\Models\Users;
use App\Controllers\AdminLoginController;

class AdminLoginControllerTest extends TestCase
{
    private $adminLoginController;

    protected function setUp(): void 
    {
        $this->adminLoginController = new AdminLoginController();
    }

    public function testaddComment() 
    {
        $_POST['password'] = 123;

        $this->adminLoginController->adminLogin();

        $this->assertTrue($_SESSION['adminauth']);
    }

    protected function tearDown(): void
    {
        $this->adminLoginController = NULL;
    }
}