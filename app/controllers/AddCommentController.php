<?php
namespace App\Controllers;
use App\Models\Comments;

class AddCommentController
{   
    public function addComment(int $lot_id)
    {
        $lot_id = 'id';
        $description = $_POST['description'];

        $comment = ( new Comments )->newComment($_SESSION['user']['id'], $lot_id, $description);

        // Доделать
    }
}