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
            ['testlogin', 1, ['id' => 1, 'login' => 'testlogin']],
            ['testlogin232ew', null, ['id' => 50, 'login' => 'testlogin232ew']]
        ];
    }

    /**
     * @dataProvider loginProvider
     */

    public function testLogin(string $login, ?int $rememberToken, array $expected)
    {
        $this->userLogin = new UserLogin($login);
        $test = $this->userLogin->login($rememberToken);

        if ($rememberToken) {
            $this->assertNotNull($_COOKIE['remember_token']);
        }

        $this->assertEquals($expected['id'], $test['id']);
        $this->assertEquals($expected['login'], $test['login']);
    }

    protected function tearDown(): void
    {
        $this->userLogin = null;
    }
}