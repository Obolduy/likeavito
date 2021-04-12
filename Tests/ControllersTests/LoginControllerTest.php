<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\User;
use App\Controllers\LoginController;

class LoginControllerTest extends TestCase
{
    private $loginController;
    private $user;
    private $model;

    protected function setUp(): void 
    {
        $this->loginController = new LoginController();
    }

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */

    public function testLogIn() 
    {
        $_POST['login'] = 'nxtewwwlogin';
        $_POST['password'] = '123456789';

        LoginController::login();

        $this->assertEquals(true, $_SESSION['userauth']);
        $this->assertEquals(20, $_SESSION['user']['id']);
    }

    protected function tearDown(): void
    {
        $this->registrationController = NULL;
        $this->user = NULL;
    }
}