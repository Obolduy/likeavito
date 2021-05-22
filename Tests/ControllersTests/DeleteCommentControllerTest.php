<?php
use PHPUnit\Framework\TestCase;
use App\Models\Comments;
use App\Controllers\DeleteCommentController;

class DeleteCommentControllerTest extends TestCase
{
    private $deleteCommentController;
    private $comment;

    protected function setUp(): void 
    {
        $this->deleteCommentController = new DeleteCommentController();
        $this->comment = new Comments();
    }

    public function deleteCommentProvider()
    {
        return [
            [2],
            [3],
            [4],
            [5]
        ];
    }

    /**
     * @dataProvider deleteCommentProvider
     */

    public function testDeleteComment($comment_id) 
    {
        $this->deleteCommentController->deleteComment($comment_id);

        $this->assertNull($this->comment->getOne('comments', $comment_id)[0]);
    }

    protected function tearDown(): void
    {
        $this->deleteCommentController = NULL;
        $this->comment = NULL;
    }
}