<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\User;
use App\Controllers\RegistrationController;

class RegistrationControllerTest extends TestCase
{
    private $registrationController;
    private $user;
    private $model;

    protected function setUp(): void 
    {
        $this->registrationController = new RegistrationController();
        $this->user = new User();
        $this->model = new Model();
    }

    /**
     * Headers already sent by PHPUnit but everythings is ok.
     */

    public function testRegistration() 
    {
        $_POST['login'] = 'nxtewwwlogin';
        $_POST['email'] = 'Elewaaaa@wadw.ru';
        $_POST['password'] = '123456789';
        $_POST['confirmPassword'] = '123456789';
        $_POST['name'] = 'Name';
        $_POST['surname'] = 'Surname';
        $_POST['city_id'] = '2';

        $registration = RegistrationController::registration();

        $data = $this->model->getOne('users', $_POST['email'], 'email');

        foreach($data as $elem) {
            $result = $elem['id'];
        }

        $this->assertEquals(20, $result);
    }

    public function testLogIn() 
    {
        $_POST['login'] = 'logsin';
        $_POST['password'] = '123456789';

        $reg = Authorization::logIn();

        $data = $this->base->getOne('users', 'logsin', 'login');

        foreach ($data as $elem) {
            $user = new User($elem['id']);
        }

        $this->assertEquals(4, $user->data['id']);
    }

    public function testRegistrationCheck() 
    {
        $login = 'logi58n';
        $password = '123456';
        $confirmPassword = '123456';

        $result = Authorization::registrationCheck($login, $password, $confirmPassword);

        $this->assertEquals(true, $result);
    }
    
    public function testAuthCheck() 
    {
        $login = 'logsin';
        $password = '123456';

        $result = Authorization::authCheck($login, $password);

        $this->assertEquals(true, $result);
    }

    protected function tearDown(): void
    {
        $this->registrationController = NULL;
        $this->user = NULL;
    }
}