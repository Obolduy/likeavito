<?php
use PHPUnit\Framework\TestCase;
use App\Models\UserGet;
use App\Controllers\DeleteUserController;

class DeleteUserControllerTest extends TestCase
{
    private $deleteUserController, $userGet;

    protected function setUp(): void 
    {
        $this->deleteUserController = new DeleteUserController();
        $this->userGet = new UserGet();
    }

    public function deleteRequestProvider()
    {
        return [
            [44, '$2y$10$Kupu5TwYWs3tBKhkfYeeIewDDc3Vp2CMhVpIOwI5Tj9PSyPFJVrIK', 'ggdndg@efgg.ru'],
            [45, '$2y$10$R4nhUOJPS1ZdAlkTltm.Ju981urn.AMDnIMqNtq5.B0TlGVTPFkvC', 'grgf@fdf.ru'],
            [46, '$2y$10$a3Rqsvy20C2JflddVHcdfeFEedZjsDa0oFU/Rgj1R4PWxsTi5qsEG', 'hnbgfvd@gfre.ru'],
            [47, '$2y$10$aKQfWUBQFWYXxgjfAkjF1OfsyYLVSCsv5BrSeMuGXPR8I.r8uBAFK', 'rgerg@dfgdf.ru']
        ];
    }

    /**
     * Tests clear, but this one don`t return $stack and return error
     * @dataProvider deleteRequestProvider
     */

    public function testDeleteRequest($user_id, $password, $email) 
    {
        $_POST['password'] = 111111;
        $_SESSION['user']['password'] = $password;
        $_SESSION['user']['email'] = $email;

        $test = $this->deleteUserController->deleteRequest();

        $file = file('/Users/vladislav/projects/maillog.txt');

        $lastString = $file[(count($file) - 1)];
        $test = str_contains($lastString, $email);
        $this->assertTrue($test);
        $this->assertNotNull($_SESSION['deletelink']);

        $stack = ['token' => $_SESSION['deletelink'], 'id' => $user_id];

        return $stack;
    }

    /**
     * @depends testDeleteRequest
     */

    public function testDeleteUser($stack) 
    {
        $_SESSION['user']['id'] = $stack['id'];

        $this->deleteUserController->deleteUser($stack['token']);

        $test = $this->userGet->getUserById($stack['id']);

        $this->assertNull($test);
    }

    protected function tearDown(): void
    {
        $this->deleteUserController = NULL;
        $this->userGet = NULL;
    }
}