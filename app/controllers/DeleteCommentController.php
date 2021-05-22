<?php
namespace App\Controllers;
use App\Models\Comments;

class DeleteCommentController
{   
    public static function deleteComment(int $comment_id): void
    {
        (new Comments)->delete('comments', $comment_id);
    }
}