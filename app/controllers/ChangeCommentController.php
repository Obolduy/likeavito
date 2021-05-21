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

            new View('changecomment', ['title' => 'Изменить комментарий']);
        } else {
            $comments->update("UPDATE comments SET description = ?, update_time = now() WHERE id = ?",
                [strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'), $comment_id]);
        }
    }
}