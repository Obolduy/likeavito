<?php
use PHPUnit\Framework\TestCase;
use App\Models\EmailVerify;
use App\Models\Database;
use App\Models\UserAuth;

class EmailVerifyTest extends TestCase
{
    private $database;

    protected function setUp(): void 
    {
        $this->database = new Database();
    }

    public function verifycationEmailProvider()
    {
        return [
            ['Token1', 66],
            ['Token2', 67],
            ['Token3', 68],
            ['Token4', 69]
        ];
    }

    /**
     * @dataProvider verifycationEmailProvider
     */

    public function testVerifycationEmail($token, $userId)
    {
        $_SESSION['user_id'] = $userId;

        $this->database->dbQuery("INSERT INTO registration_tokens SET user_id = ?, token = ?, activated = 0",
            [$userId, $token]);

        $emailVerify = new EmailVerify($token);

        $userToken = $this->database->dbQuery("SELECT * FROM registration_tokens WHERE user_id = $userId")->fetch();
        $user = $this->database->dbQuery("SELECT active FROM users WHERE id = $userId")->fetchColumn();

        $this->assertIsObject($emailVerify);
        $this->assertEquals($token, $userToken['token']);
        $this->assertEquals(1, $userToken['activated']);
        $this->assertEquals(1, $user);
    }

    protected function tearDown(): void
    {
        $this->database = NULL;
    }
}