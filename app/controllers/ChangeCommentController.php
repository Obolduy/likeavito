<?php
namespace App\Controllers;
use App\Models\Comments;
use App\View\View;

class ChangeCommentController
{   
    public function changeComment(int $comment_id): void
    {
        $comments = new Comments;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment = $comments->getOne('comments', $comment_id);

            new View('changecomment');
        } else {
            $comments->update("UPDATE comments SET description = ? WHERE id = ?", [strip_tags($_POST['description']), $comment_id]);
        }
    }
}