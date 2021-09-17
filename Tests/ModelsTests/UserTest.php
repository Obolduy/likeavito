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

    public function sendResetEmailProvider()
    {
        return [
            ['test@mail.ru'],
            ['fern@yande.ru'],
            ['newemail@iss.ru'],
            ['Emewail@wadw.ru']
        ];
    }

    public function setPasswordResetTokenProvider()
    {
        return [
            ['test@mail.ru', '8d35b1c4e76d8de0e7fd6485e1ee6957'],
            ['fern@yande.ru', '033871c67ca9bdb0f04bdb391d98d585'],
            ['newemail@iss.ru', '69efef72045d440fc065d054261eddc0'],
            ['Emewail@wadw.ru', '74d599cd9a5b638c9ab94a1e72f2eddc']
        ];
    }

    public function resetPasswordProvider()
    {
        return [
            ['test@mail.ru', '8d35b1c4e76d8de0e7fd6485e1ee6957', 111111],
            ['fern@yande.ru', '033871c67ca9bdb0f04bdb391d98d585', 111111],
            ['newemail@iss.ru', '69efef72045d440fc065d054261eddc0', 111111],
            ['Emewail@wadw.ru', '74d599cd9a5b638c9ab94a1e72f2eddc', 111111]
        ];
    }

    public function sendDeleteMailProvider()
    {
        return [
            ['test@mail.ru', 1],
            ['fern@yande.ru', 5],
            ['newemail@iss.ru', 12],
            ['Emewail@wadw.ru', 18]
        ];
    }

    public function getFullUserInfoProvider()
    {
        return [
            [null],
            [45],
            [46],
            [null]
        ];
    }

    public function registrationCheckProvider()
    {
        return [
            ['AbsoluteNew1', 'Newemail1@ada.com', 12345678, 12345678],
            ['AbsoluteNew2', 'Newemail2@ada.com', 12345678, 12345678],
            ['AbsoluteNew3', 'Newemail3@ada.com', 12345678, 12345678],
            ['AbsoluteNew4', 'Newemail4@ada.com', 12345678, 12345678]
        ];
    }

    public function authCheckProvider()
    {
        return [
            ['newlogin1', '12345678'],
            ['newlogin2', '12345678'],
            ['newlogin3', '12345678'],
            ['newlogin4', '12345678']
        ];
    }

    public function changeCheckProvider()
    {
        return [
            ['AbsoluteNew1', 12345678, 12345678, 'newlogin1', 'just1newemail@com.ru'],
            ['AbsoluteNew2', 12345678, 12345678, 'newlogin2', 'just2newemail@com.ru'],
            ['AbsoluteNew3', 12345678, 12345678, 'newlogin3', 'just3newemail@com.ru'],
            ['AbsoluteNew4', 12345678, 12345678, 'newlogin4', 'just4newemail@com.ru']
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

    public function testSendEmail() 
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

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */

    public function testSetRememberToken() 
    {
        $this->user->setRememberToken(2);

        $data = $this->user->getOne('users', 2);

        foreach ($data as $elem) {
            $this->assertNotNull($elem['remember_token']);
        }
    }

    /**
     * @dataProvider sendResetEmailProvider
     */

    public function testSendResetEmail($email) 
    {
        $this->user->sendResetEmail($email);

        $data = scandir('C:\openserver\userdata\temp\email');

        foreach ($data as $elem) {
            if (preg_match('#' . date('Y-m-d') . '_(.+)\.txt#', $elem)) {
                $match = $elem;
            }
        }

        $this->assertFileIsReadable("C:\\openserver\\userdata\\temp\\email\\$match");

        $file = file("C:\\openserver\\userdata\\temp\\email\\$match");

        $line = $file[13];

        preg_match('#http://likeavito/user/resetpassword/(.+)#', $line, $match);

        $this->assertNotNull(trim($match[0]));

        $token = $this->model->getOne('password_reset', trim($match[1]), 'token');

        foreach ($token as $elem) {
            $this->assertEquals(trim($match[1]), $elem['token']);
        }
    }

    /**
     * @dataProvider setPasswordResetTokenProvider
     */

    public function testSetPasswordResetToken($email, $link) 
    {
        $this->user->setPasswordResetToken($email, $link);

        $data = $this->user->getOne('password_reset', $email, 'email');

        foreach ($data as $elem) {
            $this->assertNotNull($elem['email']);
            $this->assertNotNull($elem['token']);
        }
    }

    /**
     * @dataProvider resetPasswordProvider
     */

    public function testResetPassword($email, $token, $password) 
    {
        $this->user->resetPassword($password, $token, $email);

        $data = $this->user->getOne('users', $email, 'email');

        foreach ($data as $elem) {
            $this->assertEquals($elem['password'], $password);
        }

        $data = $this->user->getOne('password_reset', $email, 'email');

        foreach ($data as $elem) {
            $this->assertNull($elem['token']);
        }
    }

    /**
     * @dataProvider sendDeleteMailProvider
     */

    public function testSendDeleteMail($email, $user_id) 
    {
        $this->user->sendDeleteMail($email);

        $data = scandir('C:\openserver\userdata\temp\email');

        foreach ($data as $elem) {
            if (preg_match('#' . date('Y-m-d') . '_(.+)\.txt#', $elem)) {
                $match = $elem;
            }
        }

        $this->assertFileIsReadable("C:\\openserver\\userdata\\temp\\email\\$match");

        $file = file("C:\\openserver\\userdata\\temp\\email\\$match");

        $line = $file[13];

        preg_match('#http://likeavito/user/delete/(.+)#', $line, $match);

        $this->assertNotNull(trim($match[0]));

        $stack = [$user_id => trim($match[0])];

        return $stack;
    }

    /**
     * @depends testSendDeleteMail
     */

    public function testDeleteUser($stack) 
    {
        $this->user->deleteUser($stack[0]);

        $lots = $this->model->getOne('lots', $stack[0], 'owner_id');
        $user = $this->model->getOne('users', $stack[0], 'id');
        $name = $this->model->getOne('names', $stack[0], 'user_id');
        $surname = $this->model->getOne('surnames', $stack[0], 'user_id');

        $this->assertNull($lots);
        $this->assertNull($user);
        $this->assertNull($name);
        $this->assertNull($surname);
        $this->assertTrue(!is_dir("/img/users/{$stack[0]}")); 
    }

    /**
     * @dataProvider getFullUserInfoProvider
     */

    public function testGetFullUserInfo($user_id) 
    {
        $user = $this->user->getFullUserInfo($user_id);

        foreach ($user as $elem) {
            $this->assertNotNull($elem['id']);
            $this->assertNotNull($elem['email']);
            $this->assertNotNull($elem['name']);
            $this->assertNotNull($elem['surname']);
            $this->assertNotNull($elem['city']);
        }
    }

    /**
     * @dataProvider registrationCheckProvider
     */

    public function testRegistrationCheck($login, $email, $password, $confirmPassword) 
    {
        $test = User::registrationCheck($login, $email, $password, $confirmPassword);

        $this->assertTrue($test);
    }

    /**
     * @dataProvider authCheckProvider
     */

    public function testAuthCheck($login, $password) 
    {
        $test = User::authCheck($login, $password);

        $this->assertTrue($test);
    }

    /**
     * @dataProvider changeCheckProvider
     */

    public function testChangeCheck($login, $password, $confirmPassword, $current_login, $email) 
    {
        $test = User::changeCheck($login, $password, $confirmPassword, $current_login, $email);

        $this->assertTrue($test);
    }

    protected function tearDown(): void
    {
        $this->user = NULL;
        $this->model = NULL;
    }
}