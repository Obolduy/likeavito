<?php
use PHPUnit\Framework\TestCase;
use App\Models\UserManipulate;
use App\Models\Database;

class UserManipulateTest extends TestCase
{
    private $userManipulate, $database;

    protected function setUp(): void 
    {
        $this->userManipulate = new UserManipulate();
        $this->database = new Database();
    }

    public function addUserProvider()
    {
        return [
            ['TestAddUser1', 'TestAddPassword1', 'TestAddEmail@one.com', 1],
            ['TestAddUser2', 'TestAddPassword2', 'TestAddEmail@two.com', 2],
            ['TestAddUser3', 'TestAddPassword3', 'TestAddEmail@three.com', 3],
            ['TestAddUser4', 'TestAddPassword4', 'TestAddEmail@four.com', 4],
        ];
    }

    public function addUserInfoProvider()
    {
        return [
            ['TestAddName1', 'TestAddSurname1', 70, null],
            ['TestAddName2', 'TestAddSurname2', 71, 'TestAddPic2'],
            ['TestAddName3', 'TestAddSurname3', 72, null],
            ['TestAddName4', 'TestAddSurname4', 73, 'TestAddPic4'],
        ];
    }

    public function changeUserProvider()
    {
        return [
            [70, 'TestAddEmail@one.com', 'TestChangeAddUser1', null, 'TestAddEmail@one.com', 'TestChangeAddName1', 'TestChangeAddSurname1', 5],
            [71, 'TestAddEmail@two.com', 'TestChangeAddUser2', 'TestChangeAddPassword2', 'TestAddEmail@two.com', 'TestChangeAddName2', 'TestChangeAddSurname2', 6],
            [72, 'TestAddEmail@three.com', 'TestChangeAddUser3', null, 'TestChangeEmail@three.com', 'TestChangeAddName3', 'TestChangeAddSurname3', 7],
            [73, 'TestAddEmail@four.com', 'TestChangeAddUser4', null, 'TestAddEmail@four.com', 'TestChangeAddName4', 'TestChangeAddSurname4', 8],
        ];
    }

    public function deleteUserProvider()
    {
        return [
            [70],
            [71],
            [72],
            [73]
        ];
    }

    /**
     * @dataProvider addUserProvider
     */

    public function testAddUser(string $login, string $password, string $email, int $cityId)
    {
        $this->userManipulate->addUser($login, $password, $email, $cityId);

        $test = $this->database->dbQuery('SELECT * FROM users WHERE login = ?',
            [$login])->fetch();

        $this->assertEquals($login, $test['login']);
        $this->assertEquals($password, $test['password']);
        $this->assertEquals($email, $test['email']);
        $this->assertEquals($cityId, $test['city_id']);
    }

    /**
     * @dataProvider addUserInfoProvider
     */

    public function testAddUserInfo(string $name, string $surname, int $userId, ?string $photo)
    {
        $this->userManipulate->addUserInfo($name, $surname, $userId, $photo);

        $user = $this->database->dbQuery('SELECT * FROM users WHERE id = ?',
            [$userId])->fetch();

        $testName = $this->database->dbQuery('SELECT * FROM names WHERE user_id = ?',
            [$userId])->fetch();
        $testSurname = $this->database->dbQuery('SELECT * FROM surnames WHERE user_id = ?',
            [$userId])->fetch();

        if ($photo) {
            $this->assertEquals($photo, $user['avatar']);
        }

        $this->assertEquals($name, $testName['name']);
        $this->assertEquals($surname, $testSurname['surname']);
        $this->assertEquals($userId, $testName['user_id']);
        $this->assertEquals($userId, $testSurname['user_id']);
        $this->assertEquals($testSurname['id'], $user['surname_id']);
        $this->assertEquals($testName['id'], $user['name_id']);
    }

    /**
     * @dataProvider changeUserProvider
     */

    public function testChangeUser($userId, $currentEmail, $login, $password, $email, $name, $surname, $cityId)
    {
        $this->userManipulate->changeUser($userId, $currentEmail, $login, $password, $email, $name, $surname, $cityId);

        $test = $this->database->dbQuery('SELECT u.id, u.login, u.avatar, n.name,
            s.surname, u.city_id FROM users AS u LEFT JOIN names AS n ON u.id = n.user_id
                LEFT JOIN surnames AS s ON u.id = s.user_id LEFT JOIN cities AS c
                    ON c.id = u.city_id WHERE u.id = ?', [$userId])->fetch();

        if ($currentEmail != $email || !isset($password)) {
            $file = file('/Users/vladislav/projects/maillog.txt');

            $lastString = $file[(count($file) - 1)];
            $testEmail = str_contains($lastString, $currentEmail);
            $this->assertTrue($testEmail);
        }

        $this->assertEquals($login, $test['login']);
        $this->assertEquals($cityId, $test['city_id']);
        $this->assertEquals($name, $test['name']);
        $this->assertEquals($surname, $test['surname']);
    }

    /**
     * @dataProvider deleteUserProvider
     */

    public function testDeleteUser(int $userId)
    {
        $this->userManipulate->deleteUser($userId);

        $test1 = $this->database->dbQuery('SELECT * FROM users WHERE id = ?',
            [$userId])->fetch();
        $test2 = $this->database->dbQuery('SELECT * FROM names WHERE user_id = ?',
            [$userId])->fetch();
        $test3 = $this->database->dbQuery('SELECT * FROM surnames WHERE user_id = ?',
            [$userId])->fetch();
        $test4 = $this->database->dbQuery('SELECT * FROM lots WHERE owner_id = ?',
            [$userId])->fetch();

        $this->assertFalse($test1);
        $this->assertFalse($test2);
        $this->assertFalse($test3);
        $this->assertFalse($test4);
    }

    protected function tearDown(): void
    {
        $this->userManipulate = NULL;
        $this->database = NULL;
    }
}