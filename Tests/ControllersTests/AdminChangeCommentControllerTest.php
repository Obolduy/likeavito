<?php
use PHPUnit\Framework\TestCase;
use App\Models\Comments;
use App\Controllers\AdminChangeCommentController;

class AdminChangeCommentControllerTest extends TestCase
{
    private $adminChangeCommentController;
    private $comment;

    protected function setUp(): void 
    {
        $this->adminChangeCommentController = new AdminChangeCommentController();
        $this->comment = new Comments();
    }

    public function changeCommentProvider()
    {
        return [
            [2, 'NewComment01'],
            [3, 'NewComment02'],
            [4, 'NewComment03'],
            [5, 'NewComment04']
        ];
    }

    /**
     * @dataProvider changeCommentProvider
     */

    public function testAdminChangeComment($comment_id, $description) 
    {
        $_POST['description'] = $description;

        $this->adminChangeCommentController->adminChangeComment($comment_id);

        $data = $this->comment->getOne('comments', $description, 'description');

        foreach ($data as $elem) {
            $this->assertEquals($description, $elem['description']);
        }
    }

    protected function tearDown(): void
    {
        $this->adminChangeCommentController = NULL;
        $this->comment = NULL;
    }
}