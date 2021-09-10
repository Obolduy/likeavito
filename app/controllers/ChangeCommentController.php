<?php
namespace App\Controllers;

use App\Models\CommentGet;
use App\Models\CommentManipulate;
use App\Models\CommentValidate;
use App\View\View;

class ChangeCommentController
{   
    public function changeComment(int $comment_id): void
    {
        if (!$_SESSION['http_referer']) {
            $_SESSION['http_referer'] = $_SERVER['HTTP_REFERER'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $comment = (new CommentGet($comment_id))->getComment();

            new View('changecomment', ['title' => 'Изменить комментарий', 'comment' => $comment]);
        } else {
            $text = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');

            $validate = (new CommentValidate)->checkComment($text);

            if (is_bool($validate)) {
                (new CommentManipulate())->changeComment($comment_id, $text);

                header("Location:" . $_SESSION['http_referer']);
                
                unset($_SESSION['http_referer']);
            } else {
                $_SESSION['comment_error'] = $validate;

                header("Location:" . $_SESSION['http_referer']);
                
                unset($_SESSION['http_referer']);
            }
        }
    }
}