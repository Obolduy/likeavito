<?php
namespace App\Controllers;

use App\Models\CommentManipulate;

class AdminDeleteCommentController
{   
    public static function adminDeleteComment(int $comment_id): void
    {
        (new CommentManipulate)->deleteComment($comment_id);
        
        header('Location: /admin/comments');
    }
}