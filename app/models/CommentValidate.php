<?php
namespace App\Models;

class CommentValidate
{
    private $errorArray = [];

    public function checkComment($text)
    {
        if (is_numeric($text)) {
            $this->errorArray[] = 'Пожалуйста, используйте текст';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        } else {
            return true;
        }
    }
}