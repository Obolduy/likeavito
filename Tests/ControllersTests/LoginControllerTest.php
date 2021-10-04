<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\LoginController;

class LoginControllerTest extends TestCase
{
    private $loginController;

    protected function setUp(): void 
    {
        $this->loginController = new LoginController();
    }

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */

    public function testLogin() 
    {
        $_POST['login'] = 'nxtewwwlogin';
        $_POST['password'] = '123456789';

        $this->loginController->login();

        $this->assertEquals(true, $_SESSION['userauth']);
        $this->assertEquals(20, $_SESSION['user']['id']);
    }

    public function testLoginByRememberToken() 
    {
        $rememberToken = 'fu453sdn45m543k43nfsd';

        $this->loginController->loginByRememberToken($rememberToken);

        $this->assertEquals(true, $_SESSION['userauth']);
        $this->assertEquals(67, $_SESSION['user']['id']);
    }

    protected function tearDown(): void
    {
        $this->loginController = NULL;
    }
}