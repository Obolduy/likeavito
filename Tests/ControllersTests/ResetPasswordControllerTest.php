<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Controllers\ResetPasswordController;

class ResetPasswordControllerTest extends TestCase
{
    private $resetPasswordController;
    private $user;

    protected function setUp(): void 
    {
        $this->resetPasswordController = new ResetPasswordController();
        $this->user = new User();
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
     * Tests clear, but this one don`t return $stack and return error
     * @dataProvider resetRequestProvider
     */

    public function testResetRequest($email) 
    {
        $_POST['email'] = $email;

        $test = $this->resetPasswordController->resetRequest($email);

        $dir = scandir('C:\\openserver\\userdata\\temp\\email');
        $file = $dir[count($dir) - 1];
        $file = file("C:\\openserver\\userdata\\temp\\email\\$file")[13];
        preg_match('#http://likeavito/user/resetpassword/(.+)#', $file, $link);

        $check_token = $this->user->getOne('password_reset', trim($link[1]), 'token');

        $this->assertNotNull($check_token);

        foreach ($check_token as $elem) {
            $stack = ['token' => $elem['token'], 'email' => $email];
        }

        $this->testPasswordResetForm($stack);
        return $stack;
    }

    /**
     * @depends testResetRequest
     */

    public function testPasswordResetForm($stack) 
    {
        $_POST['password'] = 222222;
        $_POST['confirmPassword'] = 222222;

        $this->resetPasswordController->passwordResetForm($stack['token']);

        $test = $this->user->getOne('users', $stack['email'], 'email');

        foreach ($test as $elem) {
            $this->assertTrue(password_verify($_POST['password'], $elem['password']));
        }
    }

    protected function tearDown(): void
    {
        $this->resetPasswordController = NULL;
        $this->user = NULL;
    }
}