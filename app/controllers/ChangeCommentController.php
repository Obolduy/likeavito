<?php
namespace App\Controllers;

use App\Models\CommentGet;
use App\Models\CommentManipulate;
use App\Models\CommentValidate;
use App\View\View;

class ChangeCommentController
{   
    public static function changeComment(int $comment_id): void
    {
        if (!$_SESSION['http_referer']) {
            $_SESSION['http_referer'] = $_SERVER['HTTP_REFERER'];
        }

        $comment = (new CommentGet)->getCommentById($comment_id);

        if ($comment['user_id'] != $_SESSION['user']['id']) {
            header('Location: /'); die();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            new View('changecomment', ['title' => 'Изменить комментарий', 'comment' => $comment]);
        } else {
            $text = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');
            $display = $_POST['display'] ?? 0;
            
            $validate = (new CommentValidate)->checkComment($text);

            if (is_bool($validate)) {
                (new CommentManipulate)->changeComment($comment_id, $display, $text);

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