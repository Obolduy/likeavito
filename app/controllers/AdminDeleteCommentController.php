<?php
namespace App\Controllers;
use App\Models\Comments;
use App\View\View;

class AdminDeleteCommentController
{   
    public function adminDeleteComment(int $comment_id): void
    {
        $comment = new Comments;

        $comment->delete('comments', $comment_id);

        header('Location: /');
    }
}