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
            ['TestLogin1', '12345678', 21, 21],
            ['TestLogin2', '12345678', 22, 22],
            ['TestLogin3', '12345678', 23, 23],
            ['TestLogin4', '12345678', 24, 24]
        ];
    }

    public function updateUserProvider()
    {
        return [
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin1', 1, 21], 21],
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin2', 4, 22], 22],
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin3', 6, 23], 23],
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin4', 5, 24], 24]
        ];
    }

    public function testSetData() 
    {
        $this->user->setData(20);

        $this->assertEquals(20, $this->user->data['id']);
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

    protected function tearDown(): void
    {
        $this->user = NULL;
        $this->model = NULL;
    }
}