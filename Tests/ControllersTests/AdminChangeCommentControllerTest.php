<?php

use PHPUnit\Framework\TestCase;
use App\Models\CommentGet;
use App\Controllers\AdminChangeCommentController;

class AdminChangeCommentControllerTest extends TestCase
{
    private $adminChangeCommentController, $comment;

    protected function setUp(): void 
    {
        $this->adminChangeCommentController = new AdminChangeCommentController();
        $this->comment = new CommentGet();
    }

    public function changeCommentProvider()
    {
        return [
            [13, 'NewComment01'],
            [14, 'NewComment02'],
            [15, 'NewComment03'],
            [16, 'NewComment04']
        ];
    }

    /**
     * @dataProvider changeCommentProvider
     */

    public function testAdminChangeComment($comment_id, $description) 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['description'] = $description;

        $this->adminChangeCommentController->adminChangeComment($comment_id);

        $data = $this->comment->getCommentById($comment_id);

        $this->assertEquals($description, $data['description']);
    }

    protected function tearDown(): void
    {
        $this->adminChangeCommentController = NULL;
        $this->comment = NULL;
    }
}