<?php
namespace App\Controllers;
use App\Models\Comments;
use App\View\View;

class AdminChangeCommentController
{   
    public function adminShowCommentsTable(): void
    {
        $comments = (new Comments)->getFullUserInfo();///////////

        new View('adminshowcomments', ['comments' => $comments]);
    }

    public function adminChangeComment(int $comment_id): void
    {
        $comments = new Comments;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment = $comments->getOne('comments', $comment_id);

            new View('adminchangecomment');
        } else {
            $comments->update("UPDATE comments SET description = ? WHERE id = ?", [strip_tags($_POST['description']), $comment_id]);
        }
    }
}