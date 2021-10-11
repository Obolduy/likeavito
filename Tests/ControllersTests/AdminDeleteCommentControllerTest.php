<?php

use PHPUnit\Framework\TestCase;
use App\Models\CommentGet;
use App\Controllers\AdminDeleteCommentController;

class AdminDeleteCommentControllerTest extends TestCase
{
    private $adminDeleteCommentController, $comment;

    protected function setUp(): void 
    {
        $this->adminDeleteCommentController = new AdminDeleteCommentController();
        $this->comment = new CommentGet();
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

        $this->assertNull($this->comment->getCommentById($comment_id));
    }

    protected function tearDown(): void
    {
        $this->adminDeleteCommentController = NULL;
        $this->comment = NULL;
    }
}