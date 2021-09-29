<?php
use PHPUnit\Framework\TestCase;
use App\Models\UserValidation;

class UserValidationTest extends TestCase
{
    private $userValidation;

    protected function setUp(): void 
    {
        $this->userValidation = new UserValidation();
    }

    public function authCheckProvider()
    {
        return [
            ['testlogin', 111111, true],
            ['TestRegUser2', 'sdsd', ['Пароль неправильный']],
            ['TestRegUdscser3', 'TestRegPassword3', ['Пользователя с таким логином не существует']],
            ['TestRegxUser4', 'TestRecxgPassword4', ['Пользователя с таким логином не существует']]
        ];
    }

    public function registrationCheckProvider()
    {
        return [
            ['testlogin', 'testlogin', 111111, 1234, ['Данный логин занят', 'Проверьте правильность ввода Вашего Email', 'Логин не может совпадать с паролем', 'Пароли не совпадают']],
            ['выпыпв', 'TestRegEmail@four.com', 111111, 111111, ['Данный Email занят', 'Пароль и логин могут содержать только латинские буквы и цифры']],
            ['df', 'dsff@fdf.com', 111111, 111111, ['Логин должен состоять из 6-32 символов']],
            ['TestRegxUsxer4', 'Tes@fPasswo.rd4', 111111,111111, true]
        ];
    }

    public function changeCheckProvider()
    {
        return [
            ['testlogin', 'TestRegEmail@four.com', 111111, 1234, ['Данный email занят', 'Пароли не совпадают']],
            ['выпыпв', 'TestRegEmail@four.com', 111111, 111111, ['Пароль и логин могут содержать только латинские буквы и цифры']],
            ['df', 'dsff@fdf.com', 111111, 111111, ['Логин должен состоять из 6-32 символов']],
            ['TestRegxUsxer4', 'Tes@fPasswo.rd4', 111111,111111, true]
        ];
    }

    /**
     * @dataProvider authCheckProvider
     */

    public function testAuthCheck($login, $password, $expected)
    {
        $test = $this->userValidation->authCheck($login, $password);
        $this->assertEquals($expected, $test);
    }

    /**
     * @dataProvider registrationCheckProvider
     */

    public function testRegistrationCheck($login, $email, $password, $confirmPassword, $expected)
    {
        $test = $this->userValidation->registrationCheck($login, $email, $password, $confirmPassword);
        $this->assertEquals($expected, $test);
    }

    /**
     * @dataProvider changeCheckProvider
     */

    public function testChangeCheck($login, $email, $password, $confirmPassword, $expected)
    {
        $test = $this->userValidation->changeCheck($login, $password, $confirmPassword, $email);
        $this->assertEquals($expected, $test);
    }

    protected function tearDown(): void
    {
        $this->userValidation = NULL;
    }
}