<?php

use PHPUnit\Framework\TestCase;
use App\Models\UserGet;
use App\Controllers\AdminChangeUserController;

class AdminChangeUserControllerTest extends TestCase
{
    private $adminChangeUserController, $user;

    protected function setUp(): void 
    {
        $this->adminChangeUserController = new AdminChangeUserController();
        $this->user = new UserGet();
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

        $getUser = $this->user->getUser($user_id);

        $this->assertEquals($login, $getUser['login']);
        $this->assertEquals($email, $getUser['email']);
        $this->assertEquals($city_id, $getUser['city_id']);
        $this->assertEquals($ban_status, $getUser['ban_status']);
        $this->assertEquals($name, $getUser['name']);
        $this->assertEquals($surname, $getUser['surname']);
    }

    protected function tearDown(): void
    {
        $this->adminChangeUserController = NULL;
        $this->user = NULL;
    }
}