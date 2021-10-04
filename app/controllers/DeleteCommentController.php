<?php
namespace App\Controllers;

use App\Models\CommentManipulate;
use App\Models\CommentGet;

class DeleteCommentController
{   
    public static function deleteComment(int $comment_id): void
    {
        $checkUser = (new CommentGet)->getCommentsByUserId($_SESSION['user']['id']);

        foreach ($checkUser as $comment) {
            if ($comment['user_id'] == $_SESSION['user']['id']) {
                (new CommentManipulate)->deleteComment($comment_id);

                header('Location: /'); die();
            }
        }
        
        header('Location: /user');
    }
}