<?php
use PHPUnit\Framework\TestCase;
use App\Models\EmailSender;

class EmailSenderTest extends TestCase
{
    private $emailSender;

    public function emailProvider()
    {
        return [
            ['Testemail@number.one'],
            ['Testemail@number.two'],
            ['Testemail@number.three'],
            ['Testemail@number.four']
        ];
    }

    public function sendRegistrationEmailProvider()
    {
        return [
            ['Testemail@number.one', 'testlink1'],
            ['Testemail@number.two', 'testlink2'],
            ['Testemail@number.three', 'testlink3'],
            ['Testemail@number.four', 'testlink4']
        ];
    }

    public function sendChangePasswordEmailProvider()
    {
        return [
            ['Testemail@number.one', 'testpassword1'],
            ['Testemail@number.two', 'testpassword2'],
            ['Testemail@number.three', 'testpassword3'],
            ['Testemail@number.four', 'testpassword4']
        ];
    }

    /**
     * @dataProvider sendRegistrationEmailProvider
     */

    public function testSendRegistrationEmail($email, $link)
    {
        $this->emailSender = new EmailSender($email);
        $this->emailSender->sendRegistrationEmail($link);

        $file = file('/Users/vladislav/projects/maillog.txt');

        $lastString = $file[(count($file) - 1)];
        $test = str_contains($lastString, $email);
        $this->assertTrue($test);
    }

    /**
     * @dataProvider emailProvider
     */

    public function testSendDeleteEmail($email)
    {
        $this->emailSender = new EmailSender($email);
        $this->emailSender->sendDeleteMail();

        $file = file('/Users/vladislav/projects/maillog.txt');

        $lastString = $file[(count($file) - 1)];
        $test = str_contains($lastString, $email);
        $this->assertTrue($test);
        $this->assertNotNull($_SESSION['deletelink']);
    }

    /**
     * @dataProvider sendChangePasswordEmailProvider
     */

    public function testSendChangePasswordEmail($email, $password)
    {
        $this->emailSender = new EmailSender($email);
        $this->emailSender->sendChangePasswordEmail($password);

        $file = file('/Users/vladislav/projects/maillog.txt');

        $lastString = $file[(count($file) - 1)];
        $test = str_contains($lastString, $email);
        $this->assertTrue($test);
        $this->assertNotNull($_SESSION['changepassword_link']);
    }

    /**
     * @dataProvider emailProvider
     */

    public function testSendChangeEmail($email)
    {
        $this->emailSender = new EmailSender($email);
        $this->emailSender->sendChangeEmail();

        $file = file('/Users/vladislav/projects/maillog.txt');

        $lastString = $file[(count($file) - 1)];
        $test = str_contains($lastString, $email);
        $this->assertTrue($test);
        $this->assertNotNull($_SESSION['changeemail_link']);
    }

    protected function tearDown(): void
    {
        $this->emailSender = NULL;
    }
}