<?php
use PHPUnit\Framework\TestCase;
use App\Models\CommentManipulate;
use App\Models\CommentGet;

class CommentManipulateTest extends TestCase
{
    private $commentManipulate;

    protected function setUp(): void 
    {
        $this->commentManipulate = new CommentManipulate();
        $this->commentGet = new CommentGet();
    }

    public function addCommentProvider()
    {
        return [
            [30, 1, 'testdesc1', 43],
            [30, 1, 'testdesc2', 44],
            [30, 1, 'testdesc3', 45],
            [30, 1, 'testdesc4', 46]
        ];
    }

    public function changeCommentProvider()
    {
        return [
            [43, 1, 'changedesc1'],
            [44, 0, 'changedesc2'],
            [45, 1, 'changedesc3'],
            [46, 0, 'changedesc4']
        ];
    }

    public function deleteCommentProvider()
    {
        return [
            [43],
            [44],
            [45],
            [46]
        ];
    }

    /**
     * @dataProvider addCommentProvider
     */

    public function testAddComment(int $lotId, int $userId, string $description, int $commentId)
    {
        $this->commentManipulate->addComment($lotId, $userId, $description);

        $test = $this->commentGet->getCommentById($commentId);

        $this->assertEquals($commentId, $test['id']);
        $this->assertEquals($userId, $test['user_id']);
        $this->assertEquals($description, $test['description']);
    }

    /**
     * @dataProvider changeCommentProvider
     */

    public function testChangeComment(int $commentId, int $display, string $commentText)
    {
        $this->commentManipulate->changeComment($commentId, $display, $commentText);

        $test = $this->commentGet->getCommentById($commentId);

        $this->assertEquals($display, $test['display']);
        $this->assertEquals($commentText, $test['description']);
    }

    /**
     * @dataProvider deleteCommentProvider
     */

    public function testDeleteComment(int $commentId)
    {
        $this->commentManipulate->deleteComment($commentId);

        $test = $this->commentGet->getCommentById($commentId);

        $this->assertFalse($test);
    }

    protected function tearDown(): void
    {
        $this->commentManipulate = NULL;
        $this->commentGet = NULL;
    }
}