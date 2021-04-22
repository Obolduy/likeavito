<?php
namespace App\Controllers;
use App\Models\Comments;
use App\View\View;

class AdminChangeCommentController
{   
    public function adminChangeComment(int $comment_id): void
    {
        $comment = new Comments;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment->getOne('comments', $comment_id);

            new View('adminchangecomment');
        } else {
            $comment->update("UPDATE comments SET description = ? WHERE id = ?", [strip_tags($_POST['description']), $comment_id]);
        }
    }
}