<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Controllers\AdminChangeUserController;

class AdminChangeUserControllerTest extends TestCase
{
    private $adminChangeUserController;
    private $user;

    protected function setUp(): void 
    {
        $this->adminChangeUserController = new AdminChangeUserController();
        $this->user = new User();
    }

    public function changeUserProvider()
    {
        return [
            [48, 'login00001', 'newadminmail1@mail.ru', 2, 0, 'newname1', 'newsurname1'],
            [43, 'login00002', 'newadminmail2@mail.ru', 3, 1, 'newname2', 'newsurname2'],
            [42, 'login00003', 'newadminmail3@mail.ru', 4, 1, 'newname3', 'newsurname3'],
            [41, 'login00004', 'newadminmail4@mail.ru', 5, 0, 'newname4', 'newsurname4']
        ];
    }

    /**
     * @dataProvider changeUserProvider
     */

    public function testAdminChangeUser($user_id, $login, $email, $city_id, $ban_status, $name, $surname) 
    {
        $_POST['login'] = $login;
        $_POST['email'] = $email;
        $_POST['city_id'] = $city_id;
        $_POST['ban_status'] = $ban_status;
        $_POST['name'] = $name;
        $_POST['surname'] = $surname;

        $this->adminChangeUserController->adminChangeUser($user_id);

        $user_test = $this->user->getOne('users', $user_id, 'id');
        $name_test = $this->user->getOne('names', $user_id, 'user_id');
        $surname_test = $this->user->getOne('surnames', $user_id, 'user_id');

        foreach ($user_test as $elem) {
            $this->assertEquals($login, $elem['login']);
            $this->assertEquals($email, $elem['email']);
            $this->assertEquals($city_id, $elem['city_id']);
            $this->assertEquals($ban_status, $elem['ban_status']);
        }

        foreach ($name_test as $elem) {
            $this->assertEquals($name, $elem['name']);
        }

        foreach ($surname_test as $elem) {
            $this->assertEquals($surname, $elem['surname']);
        }
    }

    protected function tearDown(): void
    {
        $this->adminChangeUserController = NULL;
        $this->user = NULL;
    }
}