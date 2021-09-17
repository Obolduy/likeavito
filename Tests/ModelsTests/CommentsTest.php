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

    public function getFullCommentInfoProvider()
    {
        return [
            [2, [2, 'nxtewwwlogin']],
            [3, [3, 'mjhgggtt']],
            [4, [4, 'newlogin']],
            [5, [5, 'login1234']]
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
     * @dataProvider getFullCommentInfoProvider
     */

    public function testGetFullCommentInfo($comment_id, $expected) 
    {
        $data = $this->comment->getFullCommentInfo($comment_id);

        foreach ($data as $elem) {
            $this->assertEquals($expected[0], $elem['id']);
            $this->assertEquals($expected[1], $elem['login']);
        }
    }

    protected function tearDown(): void
    {
        $this->comment = NULL;
    }
}