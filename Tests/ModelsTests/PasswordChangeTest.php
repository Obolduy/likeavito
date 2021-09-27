<?php
use PHPUnit\Framework\TestCase;
use App\Models\PasswordChange;
use App\Models\Database;

class PasswordChangeTest extends TestCase
{
    private $passwordChange, $database;

    protected function setUp(): void 
    {
        $this->database = new Database();
    }

    public function addPasswordToChangeTableProvider()
    {
        return [
            ['newchange1@email.verify', '$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2', 'token123456789'],
            ['newchange2@email.verify', '$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.', 'token1234567890'],
            ['newchange3@email.verify', '$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K', 'token12345678901'],
            ['newchange4@email.verify', '$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m', 'token123456789012']
        ];
    }

    public function changePasswordProvider()
    {
        return [
            ['token123456789', 66],
            ['token1234567890', 67],
            ['token12345678901', 68],
            ['token123456789012', 69]
        ];
    }

    /**
     * @dataProvider addPasswordToChangeTableProvider
     */

    public function testAddPasswordToChangeTable($email, $password, $token)
    {
        $_SESSION['changepassword_link'] = $token;

        $this->passwordChange = new PasswordChange($email, $password);
        $this->passwordChange->addPasswordToChangeTable();

        $test = $this->database->dbQuery("SELECT * FROM passwords_changes WHERE link = ?", [$token])->fetch();
        
        $this->assertEquals($password, $test['password']);
        $this->assertEquals($email, $test['email']);
    }

    /**
     * @dataProvider changePasswordProvider
     */

    public function testChangePassword($token, $userId)
    {
        $_SESSION['user_id'] = $userId;

        $this->passwordChange = new PasswordChange();
        $test1 = $this->passwordChange->changePassword($token);

        $password = $this->database->dbQuery("SELECT password FROM passwords_changes WHERE link = ?", [$token])->fetchColumn();
        $user = $this->database->dbQuery("SELECT password FROM users WHERE id = ?", [$userId])->fetchColumn();

        $this->assertTrue($test1);
        $this->assertEquals($password, $user);
    }

    protected function tearDown(): void
    {
        $this->passwordChange = null;
        $this->database = null;
    }
}