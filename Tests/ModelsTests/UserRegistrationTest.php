<?php

use PHPUnit\Framework\TestCase;
use App\Models\UserRegistration;
use App\Models\UserGet;

class UserRegistrationTest extends TestCase
{
    private $userRegistration, $userGet;

    protected function setUp(): void 
    {
        $this->userGet = new UserGet();
    }

    public function registrationProvider()
    {
        return [
            ['TestRegUser1', 'TestRegPassword1', 'TestRegEmail@one.com', 1, 'RegName1', 'RegSurname1'],
            ['TestRegUser2', 'TestRegPassword2', 'TestRegEmail@two.com', 2, 'RegName2', 'RegSurname2'],
            ['TestRegUser3', 'TestRegPassword3', 'TestRegEmail@three.com', 3, 'RegName3', 'RegSurname3'],
            ['TestRegUser4', 'TestRegPassword4', 'TestRegEmail@four.com', 4, 'RegName4', 'RegSurname4'],
        ];
    }

    /**
     * @dataProvider registrationProvider
     */

    public function testRegistration(string $login, string $password, string $email, int $city_id, string $name, 
        string $surname)
    {
        $this->userRegistration = new UserRegistration($login, $password, $email, $city_id, $name, 
            $surname);
        $testSession = $this->userRegistration->registration();

        $test = $this->userGet->getUserByLogin($login);

        $this->assertEquals($test['id'], $testSession['id']);
        $this->assertEquals($login, $testSession['login']);
        $this->assertEquals($email, $testSession['email']);
        $this->assertEquals($testSession['id'], $test['id']);
        $this->assertEquals($login, $test['login']);
        $this->assertEquals($email, $test['email']);
        $this->assertEquals($city_id, $test['city_id']);

        $test = $this->userGet->getUser($test['id']);

        $this->assertEquals($name, $test['name']);
        $this->assertEquals($surname, $test['surname']);
    }

    protected function tearDown(): void
    {
        $this->userRegistration = null;
        $this->userGet = null;
    }
}