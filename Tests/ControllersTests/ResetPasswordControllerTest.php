<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\ResetPasswordController;
use App\Models\Database;

class ResetPasswordControllerTest extends TestCase
{
    private $resetPasswordController;
    private $user;

    protected function setUp(): void 
    {
        $this->resetPasswordController = new ResetPasswordController();
        $this->user = new Database();
    }

    public function resetRequestProvider()
    {
        return [
            ['test@mail.ru'],
            ['newemail@iss.ru'],
            ['fern@yande.ru'],
            ['Emewail@wadw.ru']
        ];
    }

    /**
     * @dataProvider resetRequestProvider
     */

    public function testResetRequest($email) 
    {
        $_POST['email'] = $email;

        $this->resetPasswordController->resetRequest($email);

        $file = file('/Users/vladislav/projects/maillog.txt');

        $lastString = $file[(count($file) - 1)];
        $test = str_contains($lastString, $email);
        $this->assertTrue($test);
    }

    /**
     * @dataProvider resetRequestProvider
     */

    public function testPasswordResetForm($email) 
    {
        $_POST['password'] = 222222;
        $_POST['confirmPassword'] = 222222;
        $token = 'fjnfrenfrefnerfnw3243';

        $this->resetPasswordController->passwordResetForm($token);

        $test = $this->user->dbQuery("SELECT password FROM users WHERE email = ?", [$email])->fetchColumn();

        $this->assertTrue(password_verify($_POST['password'], $test));
    }

    protected function tearDown(): void
    {
        $this->resetPasswordController = NULL;
        $this->user = NULL;
    }
}