<?php
namespace App\Controllers;
use App\Models\Comments;

class AddCommentController
{   
    public static function addComment(int $category_id, int $lot_id)
    {
        $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');

        $comment = ( new Comments )->newComment($lot_id, $_SESSION['user']['id'], $description);
        
        header("Location: /category/$category_id/$lot_id");
    }
}