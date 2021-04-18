<?php
use PHPUnit\Framework\TestCase;
use App\Models\Comments;

class CommentsTest extends TestCase
{
    private $comment;

    protected function setUp(): void 
    {
        $this->comment = new Comments();
    }

    public function addCommentProvider()
    {
        return [
            ['1', '20', 'newdesc6', 6],
            ['2', '15', 'newdesc7', 7],
            ['3', '17', 'newdesc8', 8],
            ['4', '5', 'newdesc9', 9]
        ];
    }

    /**
     * @dataProvider addCommentProvider
     */

    public function testNewComment($lot_id, $user_id, $description, $expected) 
    {
        $this->comment->newComment($lot_id, $user_id, $description);

        $data = $this->comment->getOne('comments', $description, 'description');

        foreach ($data as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    protected function tearDown(): void
    {
        $this->comment = NULL;
    }
}