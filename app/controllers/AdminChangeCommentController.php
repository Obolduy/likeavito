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
        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $comments = new Pagination(($_GET['page'] * 10) - 10, 10);
        $comments->pagination((new CommentGet)->getAllComments()->queryString);

        new View('adminshowcomments', ['comments' => $comments->table, 'page_count' => $comments->pageCount, 'title' => 'Просмотр комментариев']);
    }

    public static function adminChangeComment(int $comment_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment = (new CommentGet)->getCommentById($comment_id);

            new View('adminchangecomment', ['comment' => $comment, 'title' => 'Изменить комментарий']);
        } else {
            $display = $_POST['display'] ?? 0;

            (new CommentManipulate)->changeComment($comment_id, $display,
                strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'));
            
            header("Location: /admin/change/comment/$comment_id");
        }
    }
}