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

    public function changeCommentProvider()
    {
        return [
            [1, 'absolutenewdesc6', 1],
            [2, 'absolutenewdesc7', 2],
            [3, 'absolutenewdesc8', 3],
            [4, 'absolutenewdesc9', 4]
        ];
    }

    public function deleteCommentProvider()
    {
        return [
            [6],
            [7],
            [8],
            [9]
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

    /**
     * @dataProvider changeCommentProvider
     */

    public function testChangeComment($comment_id, $description, $expected) 
    {
        $this->comment->changeComment($comment_id, $description);

        $data = $this->comment->getOne('comments', $description, 'description');

        foreach ($data as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider deleteCommentProvider
     */

    public function testDeleteComment($comment_id) 
    {
        $this->comment->deleteComment($comment_id);

        $data = $this->comment->getOne('comments', $comment_id);

        foreach ($data as $elem) {
            $this->assertNull($elem['id']);
        }
    }

    protected function tearDown(): void
    {
        $this->comment = NULL;
    }
}