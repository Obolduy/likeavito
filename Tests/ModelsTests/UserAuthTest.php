<?php
use PHPUnit\Framework\TestCase;
use App\Models\UserAuth;

class UserAuthTest extends TestCase
{
    private $userAuth;

    public function userAuthProvider()
    {
        return [
            [1, 'rejc', 'Фдвенецатьадин', 'Минск', null],
            [1, 'rejc', 'Фдвенецатьадин', 'Минск', 'a079956d02ed4c786279c09f96df2f49']
        ];
    }

    /**
     * @dataProvider userAuthProvider
     */

    public function testUserAuth($id, $name, $surname, $city, $rememberToken)
    {
        if ($rememberToken == null) {
            $_COOKIE['remember_token'] = $rememberToken;
        } else {
            $_SESSION['user_id'] = $id;
        }
        
        $this->userAuth = new UserAuth();

        $this->assertEquals($id, $this->userAuth->data['id']);
        $this->assertEquals($name, $this->userAuth->data['name']);
        $this->assertEquals($surname, $this->userAuth->data['surname']);
        $this->assertEquals($city, $this->userAuth->data['city_name']);
    }

    protected function tearDown(): void
    {
        $this->userAuth = NULL;
    }
}