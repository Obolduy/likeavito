<?php
namespace App\Controllers;
use App\Models\Comments;
use App\View\View;

class AdminChangeCommentController
{   
    public static function adminShowCommentsTable(): void
    {
        $comments = (new Comments)->getFullCommentInfo();

        new View('adminshowcomments', ['comments' => $comments, 'title' => 'Просмотр комментариев']);
    }

    public static function adminChangeComment(int $comment_id): void
    {
        $comments = new Comments;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment = $comments->getOne('comments', $comment_id);

            new View('adminchangecomment', ['comment' => $comment, 'title' => 'Изменить комментарий']);
        } else {
            $comments->update("UPDATE comments SET description = ? WHERE id = ?", [strip_tags($_POST['description']), $comment_id]);
        }
    }
}