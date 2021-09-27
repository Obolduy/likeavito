<?php
session_start();
use PHPUnit\Framework\TestCase;
use App\Models\UserLogin;

class UserLoginTest extends TestCase
{
    private $userLogin;

    public function loginProvider()
    {
        return [
            ['testlogin', 1, 1],
            ['testlogin232ew', 1, 50]
        ];
    }

    /**
     * @dataProvider loginProvider
     */

    public function testLogin(string $login, ?int $rememberToken, $expected)
    {
        $this->userLogin = new UserLogin($login);
        $this->userLogin->login($rememberToken);

        if ($rememberToken) {
            $this->assertNotNull($_COOKIE['remember_token']);
        }

        $this->assertEquals($expected, $_SESSION['user_id']);
    }

    protected function tearDown(): void
    {
        $this->userLogin = null;
    }
}