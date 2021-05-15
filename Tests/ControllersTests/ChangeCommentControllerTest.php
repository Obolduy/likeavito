<?php
use PHPUnit\Framework\TestCase;
use App\Models\Comments;
use App\Controllers\ChangeCommentController;

class ChangeCommentControllerTest extends TestCase
{
    private $changeCommentController;
    private $comment;

    protected function setUp(): void 
    {
        $this->changeCommentController = new ChangeCommentController();
        $this->comment = new Comments();
    }

    public function changeCommentProvider()
    {
        return [
            [2, 'NewComment001'],
            [3, 'NewComment002'],
            [4, 'NewComment003'],
            [5, 'NewComment004']
        ];
    }

    /**
     * @dataProvider changeCommentProvider
     */

    public function testChangeComment($comment_id, $description) 
    {
        $_POST['description'] = $description;

        $this->changeCommentController->changeComment($comment_id);

        $data = $this->comment->getOne('comments', $description, 'description');

        foreach ($data as $elem) {
            $this->assertEquals($description, $elem['description']);
        }
    }

    protected function tearDown(): void
    {
        $this->changeCommentController = NULL;
        $this->comment = NULL;
    }
}