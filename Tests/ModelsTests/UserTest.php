<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Model;

class UserTest extends TestCase
{
    private $user;
    private $model;

    protected function setUp(): void 
    {
        $this->user = new User();
        $this->model = new Model();
    }

    public function addUserProvider()
    {
        return [
            ['TestLogin1', '12345678', 'just1newemail@com.ru', 1, 21],
            ['TestLogin2', '12345678', 'just2newemail@com.ru', 2, 22],
            ['TestLogin3', '12345678', 'just3newemail@com.ru', 3, 23],
            ['TestLogin4', '12345678', 'just4newemail@com.ru', 4, 24]
        ];
    }

    public function addUserInfoProvider()
    {
        return [
            ['NewName1', 'NewSurname1', 21, 21],
            ['NewName2', 'NewSurname2', 22, 22],
            ['NewName3', 'NewSurname3', 23, 23],
            ['NewName4', 'NewSurname4', 24, 24]
        ];
    }

    public function testSetData() 
    {
        $this->user->setData(2);

        $this->assertEquals(2, $this->user->data['id']);

        $user_data = $this->user->data;
        
        return $user_data;
    }
    
    /**
     * @dataProvider addUserProvider
     */
    public function testAddUser(string $login, string $password, string $email, int $city_id, $expected) 
    {
        $this->user->addUser($login, $password, $email, $city_id);

        $data = $this->user->getOne('users', $login, 'login');

        foreach ($data as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider addUserInfoProvider
     */
    public function testAddUserInfo(string $name, string $surname, int $user_id, $expected) 
    {
        $this->user->addUserInfo($name, $surname, $user_id);

        $data = $this->user->getOne('names', $name, 'name');

        foreach ($data as $elem) {
            $this->assertEquals($expected, $elem['user_id']);
        }
    }

    public function testsendEmail() 
    {
        $this->user->sendEmail('TestEmail@mail.ru');

        $data = scandir('C:\openserver\userdata\temp\email');

        foreach ($data as $elem) {
            if (preg_match('#2021-04-18_(.+)\.txt#', $elem)) {
                $match = $elem;
            }
        }

        $this->assertFileIsReadable("C:\\openserver\\userdata\\temp\\email\\$match");
    }

    /**
     * @depends testSetData
     */
    public function testVerifycationEmail($user_data) 
    {
        $_SESSION['user'] = $user_data;

        $this->user->verifycationEmail();

        $data = $this->user->getOne('users', $_SESSION['user']['id']);

        foreach ($data as $elem) {
            $this->assertEquals(1, $elem['active']);
        }
    }

    protected function tearDown(): void
    {
        $this->user = NULL;
        $this->model = NULL;
    }
}