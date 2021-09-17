<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Controllers\DeleteUserController;

class DeleteUserControllerTest extends TestCase
{
    private $deleteUserController;
    private $user;

    protected function setUp(): void 
    {
        $this->deleteUserController = new DeleteUserController();
        $this->user = new User();
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

        $this->assertIsNotString($test);

        $dir = scandir('C:\\openserver\\userdata\\temp\\email');

        $file = $dir[count($dir) - 1];
        $file = file("C:\\openserver\\userdata\\temp\\email\\$file")[13];

        preg_match('#http://likeavito/user/delete/.+#', $file, $link);
        $this->assertEquals(trim($link[0]), "http://likeavito/user/delete/{$_SESSION['deletelink']}");

        $stack = ['token' => $_SESSION['deletelink'], 'id' => $user_id];

        $this->testDeleteUser($stack);
        return $stack;
    }

    /**
     * @depends testDeleteRequest
     */

    public function testDeleteUser($stack) 
    {
        $_SESSION['user']['id'] = $stack['id'];

        $this->deleteUserController->deleteUser($stack['token']);

        $test = $this->user->getOne('users', $stack['id']);

        $this->assertNull($test);
    }

    protected function tearDown(): void
    {
        $this->deleteUserController = NULL;
        $this->user = NULL;
    }
}