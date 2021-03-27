<?php
use PHPUnit\Framework\TestCase;
require 'Authorization.php';

class AuthorizationTest extends TestCase
{
    private $auth;
    private $base;

    protected function setUp(): void 
    {
        $this->auth = new Authorization();
        $this->base = new Base();
    }

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */
    
    public function testRegistration() 
    {
        $_POST['login'] = 'logsewesin';
        $_POST['email'] = 'Emasidddddl';
        $_POST['password'] = '123456789';
        $_POST['confirmPassword'] = '123456789';
        $_POST['name'] = 'Name';
        $_POST['surname'] = 'Surname';
        $_POST['city_id'] = '2';

        $reg = Authorization::registration();

        $data = $this->base->getOne('users', 'login', 'login');

        foreach($data as $elem) {
            $result = $elem['id'];
        }

        $this->assertEquals(2, $result);
    }

    public function testRegistrationCheck() 
    {
        $login = 'logi58n';
        $password = '123456';
        $confirmPassword = '123456';

        $result = Authorization::registrationCheck($login, $password, $confirmPassword);

        $this->assertEquals(true, $result);
    }

    protected function tearDown(): void
    {
        $this->auth = NULL;
        $this->base = NULL;
    }
}