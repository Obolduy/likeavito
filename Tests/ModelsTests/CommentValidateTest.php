<?php
use PHPUnit\Framework\TestCase;
use App\Models\CommentValidate;

class CommentValidateTest extends TestCase
{
    private $commentValidate;

    protected function setUp(): void 
    {
        $this->commentValidate = new CommentValidate();
    }

    public function checkCommentProvider()
    {
        return [
            ['Test', true],
            ['Test1234', true],
            [132424, ['Пожалуйста, напишите Ваш комментарий, используя слова']],
            ['Пожалуйста, используйте текст', true],
            ['\\@#$%^&*&^%$#$%^&*(', ['Пожалуйста, напишите Ваш комментарий, используя слова']]
        ];
    }

    /**
     * @dataProvider checkCommentProvider
     */

    public function testCheckComment($text, $expected)
    {
        $test = $this->commentValidate->checkComment($text);
        $this->assertEquals($expected, $test);
    }

    protected function tearDown(): void
    {
        $this->commentValidate = NULL;
    }
}