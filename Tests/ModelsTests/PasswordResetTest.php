<?php
use PHPUnit\Framework\TestCase;
use App\Models\PasswordReset;
use App\Models\Database;

class PasswordResetTest extends TestCase
{
    private $passwordReset, $database;

    protected function setUp(): void 
    {
        $this->database = new Database();
    }

    public function passwordResetTokenProvider()
    {
        return [
            ['token123456789', 'newchange1@email.verify'],
            ['token1234567890', 'newchange2@email.verify'],
            ['token12345678901', 'newchange3@email.verify'],
            ['token123456789012', 'newchange4@email.verify']
        ];
    }

    public function resetPasswordProvider()
    {
        return [
            ['$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2', 'token123456789', 'newchange1@email.verify'],
            ['$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.', 'token1234567890', 'newchange2@email.verify'],
            ['$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K', 'token12345678901', 'newchange3@email.verify'],
            ['$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m', 'token123456789012', 'newchange4@email.verify']
        ];
    }

    /**
     * @dataProvider passwordResetTokenProvider
     */

    public function testSetPasswordResetToken($token, $email)
    {
        $this->passwordReset = new PasswordReset($email);
        $this->passwordReset->passwordResetRequest($token);

        $test = $this->database->dbQuery("SELECT * FROM password_reset WHERE token = ?", [$token])->fetch();
        $this->assertEquals($email, $test['email']);
        $this->assertEquals($token, $test['token']);
    }

    /**
     * @dataProvider passwordResetTokenProvider
     */

    public function testGetEmailByToken($token, $email)
    {
        $this->passwordReset = new PasswordReset();
        $this->passwordReset->getEmailByToken($token);

        $this->assertEquals($email, $this->passwordReset->email);
    }

    /**
     * @dataProvider resetPasswordProvider
     */

    public function testResetPassword($password, $token, $email)
    {
        $this->passwordReset = new PasswordReset($email, $password);
        $this->passwordReset->resetPassword($token);

        $testReset = $this->database->dbQuery("SELECT * FROM password_reset WHERE token = ?", [$token])->fetch();
        $testUser = $this->database->dbQuery("SELECT * FROM users WHERE password = ?", [$password])->fetch();

        $this->assertFalse($testReset);
        $this->assertIsArray($testUser);
    }

    protected function tearDown(): void
    {
        $this->passwordReset = null;
        $this->database = null;
    }
}