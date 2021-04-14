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

    public function testSetData() 
    {
        $this->user->setData(20);

        $this->assertEquals(20, $this->user->data['id']);
    }

    protected function tearDown(): void
    {
        $this->user = NULL;
        $this->model = NULL;
    }
}