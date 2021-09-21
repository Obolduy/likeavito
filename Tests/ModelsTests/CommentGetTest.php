<?php
use PHPUnit\Framework\TestCase;
use App\Models\CommentGet;

class CommentGetTest extends TestCase
{
    private $commentGet;

    protected function setUp(): void 
    {
        $this->commentGet = new CommentGet();
    }

    public function testGetLotComments()
    {
        $test = $this->commentGet->getLotComments(30);

        $id = 15;
        for ($i = 0; $i < count($test); $i++) {
            $id += $i;
            $this->assertEquals($id, $test[$i]['id']);
        }
    }

    public function testGetCommentById()
    {
        $test = $this->commentGet->getCommentById(18);
        
        $this->assertEquals(30, $test['lot_id']);
        $this->assertEquals('dfsfsdfsd', $test['description']);
        $this->assertEquals(1, $test['display']);
        $this->assertEquals('testlogin', $test['login']);
    }

    public function testGetCommentsByUserId()
    {
        $test = $this->commentGet->getCommentsByUserId(30);

        $this->assertNotNull($test);
    }

    protected function tearDown(): void
    {
        $this->commentGet = NULL;
    }
}