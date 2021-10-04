<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\RegistrationController;

class RegistrationControllerTest extends TestCase
{
    private $registrationController;

    protected function setUp(): void 
    {
        $this->registrationController = new RegistrationController();
    }

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */

    public function testRegistration() 
    {
        $_POST['login'] = 'nxtewwwlogin';
        $_POST['email'] = 'Elewaaaa@wadw.ru';
        $_POST['password'] = '123456789';
        $_POST['confirmPassword'] = '123456789';
        $_POST['name'] = 'Name';
        $_POST['surname'] = 'Surname';
        $_POST['city_id'] = '2';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $this->registrationController->registration();

        $this->assertNotNull($_SESSION['user']);
    }

    protected function tearDown(): void
    {
        $this->registrationController = NULL;
    }
}