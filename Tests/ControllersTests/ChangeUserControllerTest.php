<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\User;
use App\Controllers\ChangeUserController;

class ChangeUserControllerTest extends TestCase
{
    private $changeUserController;
    private $model;
    private $user;

    protected function setUp(): void 
    {
        $this->changeUserController = new ChangeUserController();
        $this->model = new Model();
        $this->user = new User();
    }

    public function changeUserProvider()
    {
        return [
            ['absnewlogin1', 12345678, 12345678, 'newname1', 'newsurname1', 'email1@com.ru', 21, 'newlogin1', 'newlogin1'],
            ['absnewlogin2', 12345678, 12345678, 'newname2', 'newsurname2', 'email2@com.ru', 22, 'newlogin2', 'newlogin2'],
            ['absnewlogin3', 12345678, 12345678, 'newname3', 'newsurname3', 'email3@com.ru', 23, 'newlogin3', 'newlogin3'],
            ['absnewlogin4', 12345678, 12345678, 'newname4', 'newsurname4', 'email4@com.ru', 24, 'newlogin4', 'newlogin4']
        ];
    }

    /**
     * @dataProvider changeUserProvider
     */

    public function testChangeInformation($login, $password, $confirmPassword, $name, $surname, $email, $user_id, $current_login, $expected) 
    {
        $_SESSION['user']['login'] = $current_login;

        $this->changeUserController->changeInformation($login, $password, $confirmPassword, $name, $surname, $email, $user_id);

        $data = $this->model->getOne('users', $user_id);

        foreach($data as $elem) {
            $this->assertNotNull($elem['updated_at']);
        }
    }

    protected function tearDown(): void
    {
        $this->changeUserController = NULL;
        $this->model = NULL;
        $this->user = NULL;
    }
}