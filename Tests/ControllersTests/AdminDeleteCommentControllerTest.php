<?php
use PHPUnit\Framework\TestCase;
use App\Models\Comments;
use App\Controllers\AdminDeleteCommentController;

class AdminDeleteCommentControllerTest extends TestCase
{
    private $adminDeleteCommentController;
    private $comment;

    protected function setUp(): void 
    {
        $this->adminDeleteCommentController = new AdminDeleteCommentController();
        $this->comment = new Comments();
    }

    public function adminDeleteCommentProvider()
    {
        return [
            [19],
            [20],
            [21],
            [22]
        ];
    }

    /**
     * @dataProvider adminDeleteCommentProvider
     * headers already sent by phpunit
     */

    public function testAdminDeleteComment($comment_id) 
    {
        $this->adminDeleteCommentController->adminDeleteComment($comment_id);

        $this->assertNull($this->comment->getOne('comments', $comment_id)[0]);
    }

    protected function tearDown(): void
    {
        $this->adminDeleteCommentController = NULL;
        $this->comment = NULL;
    }
}