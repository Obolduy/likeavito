<?php
namespace App\Controllers;

use App\Models\CommentManipulate;

class DeleteCommentController
{   
    public static function deleteComment(int $comment_id): void
    {
        (new CommentManipulate)->deleteComment($comment_id);
    }
}