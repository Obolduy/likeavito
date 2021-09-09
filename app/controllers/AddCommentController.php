<?php
namespace App\Controllers;

use App\Models\CommentAdd;
use App\Models\UserAuth;

class AddCommentController
{   
    public static function addComment(int $category_id, int $lot_id)
    {
        $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');

        (new CommentAdd)->addComment($lot_id, (new UserAuth)->data['id'], $description);
        
        header("Location: /category/$category_id/$lot_id");
    }
}