<?php
namespace App\Controllers;
use App\Models\Comments;

class AddCommentController
{   
    public function addComment(int $lot_id)
    {
        $description = strip_tags($_POST['description']);

        $comment = ( new Comments )->newComment($lot_id, $_SESSION['user']['id'], $description);
    }
}