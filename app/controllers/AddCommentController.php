<?php
namespace App\Controllers;

use App\Models\AddComment;
use App\Models\AuthUser;

class AddCommentController
{   
    public static function addComment(int $category_id, int $lot_id)
    {
        $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');

        (new AddComment)->addComment($lot_id, (new AuthUser)->data['id'], $description);
        
        header("Location: /category/$category_id/$lot_id");
    }
}