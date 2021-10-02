<?php
use PHPUnit\Framework\TestCase;
use App\Models\Database;
use App\Controllers\ChangeCommentController;

class ChangeCommentControllerTest extends TestCase
{
    private $changeCommentController;
    private $database;

    protected function setUp(): void 
    {
        $this->changeCommentController = new ChangeCommentController();
        $this->database = new Database();
    }

    public function changeCommentProvider()
    {
        return [
            [2, 'NewComment001', 50],
            [3, 'NewComment002', 23],
            [4, 'NewComment003', 3],
            [5, 'NewComment004', 1]
        ];
    }

    /**
     * @dataProvider changeCommentProvider
     */

    public function testChangeComment($commentId, $description, $userId) 
    {
        $_POST['description'] = $description;
        $_SESSION['user']['id'] = $userId;

        $this->changeCommentController->changeComment($commentId);

        $test = $this->database->dbQuery("SELECT * FROM comments WHERE id = $commentId")->fetch();
        $this->assertEquals($description, $test['description']);
    }

    protected function tearDown(): void
    {
        $this->changeCommentController = NULL;
        $this->database = NULL;
    }
}