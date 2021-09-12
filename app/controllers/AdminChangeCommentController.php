<?php
namespace App\Controllers;

use App\Models\Pagination;
use App\Models\CommentGet;
use App\Models\CommentManipulate;
use App\View\View;

class AdminChangeCommentController
{   
    public static function adminShowCommentsTable(): void
    {
        $comments = (new Pagination('comments', (($_GET['page'] * 10) - 10)))->pagination();

        new View('adminshowcomments', ['comments' => $comments, 'title' => 'Просмотр комментариев']);
    }

    public static function adminChangeComment(int $comment_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment = (new CommentGet)->getCommentById($comment_id);

            new View('adminchangecomment', ['comment' => $comment, 'title' => 'Изменить комментарий']);
        } else {
            (new CommentManipulate)->changeComment($comment_id,
                strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'), $_POST['display']);
        }
    }
}