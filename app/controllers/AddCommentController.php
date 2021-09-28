<?php
namespace App\Controllers;

use App\Models\CommentManipulate;

class AddCommentController
{   
    public static function addComment(int $category_id, int $lot_id)
    {
        $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');

        (new CommentManipulate)->addComment($lot_id, $_SESSION['user']['id'], $description);
        
        header("Location: /category/$category_id/$lot_id");
    }
}