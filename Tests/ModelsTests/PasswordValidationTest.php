<?php
use PHPUnit\Framework\TestCase;
use App\Models\PasswordValidation;

class PasswordValidationTest extends TestCase
{
    private $passwordValidation;

    protected function setUp(): void 
    {
        $this->passwordValidation = new PasswordValidation();
    }

    public function checkPasswordProvider()
    {
        return [
            ['password', 'password', true],
            [123456, 123456, true],
            ['dsfuh', 'ddvsv', ['Пароли не совпадают']],
            ['вымвым', 'вымвым', ['Пароль может содержать только латинские буквы и цифры']],
            ['ваавава', 'fdfdsfs', ['Пароль может содержать только латинские буквы и цифры', 'Пароли не совпадают']]
        ];
    }

    /**
     * @dataProvider checkPasswordProvider
     */

    public function testCheckLotData($password, $confirmPassword, $expected)
    {
        $test = $this->passwordValidation->checkPassword($password, $confirmPassword);
        $this->assertEquals($expected, $test);
    }

    protected function tearDown(): void
    {
        $this->passwordValidation = NULL;
    }
}