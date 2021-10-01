<?php
use PHPUnit\Framework\TestCase;
use App\Models\CommentGet;
use App\Controllers\AddCommentController;

class AddCommentControllerTest extends TestCase
{
    private $addCommentController, $commentGet;

    protected function setUp(): void 
    {
        $this->addCommentController = new AddCommentController();
        $this->commentGet = new CommentGet();
    }

    public function addCommentProvider()
    {
        return [
            ['NewComment1', 5, 54, 1, 50],
            ['NewComment2', 1, 2, 70, 51],
            ['NewComment3', 3, 50, 68, 52],
            ['NewComment4', 6, 70, 1, 53]
        ];
    }

    /**
     * @dataProvider addCommentProvider
     */

    public function testAddComment($description, $categoryId, $lotId, $userid, $commentId) 
    {
        $_POST['description'] = $description;
        $_SESSION['user']['id'] = $userid;

        $this->addCommentController->addComment($categoryId, $lotId);

        $data = $this->commentGet->getCommentById($commentId);

        $this->assertIsArray($data);
    }

    protected function tearDown(): void
    {
        $this->addLotController = NULL;
        $this->model = NULL;
    }
}