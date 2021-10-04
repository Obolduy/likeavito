<?php
namespace App\Controllers;

use App\Models\CommentManipulate;
use App\Models\CommentGet;

class DeleteCommentController
{   
    public static function deleteComment(int $comment_id): void
    {
        $comment = (new CommentGet)->getCommentById($comment_id);

        if ($comment['user_id'] == $_SESSION['user']['id']) {
            (new CommentManipulate)->deleteComment($comment_id);

            header('Location: /user/showcomments');
        }
        header('Location: /'); die();
    }
}