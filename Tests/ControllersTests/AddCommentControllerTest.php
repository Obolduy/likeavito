<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;
use App\Models\Lots;
use App\Controllers\AddCommentController;

class AddCommentControllerTest extends TestCase
{
    private $addCommentController;
    private $model;

    protected function setUp(): void 
    {
        $this->addCommentController = new AddCommentController();
        $this->model = new Model();
    }

    public function testaddComment() 
    {
        $_POST['description'] = 'Description test comment';
        $_POST['lot_id'] = 1;
        $_SESSION['user']['id'] = 20;

        $this->addCommentController->addComment($_POST['lot_id']);

        $data = $this->model->getOne('comments', 'Description test comment', 'description');

        foreach($data as $elem) {
            $result = $elem['id'];
        }

        $this->assertEquals(1, $result);
    }

    protected function tearDown(): void
    {
        $this->addLotController = NULL;
        $this->model = NULL;
    }
}