<?php
namespace App\Models;

class CommentValidate extends Model
{
    private $errorArray = [];

    public function checkComment($text)
    {
        if (is_numeric($text) || !preg_match('#[A-Za-zА-Яа-я]+#u', $text)) {
            $this->errorArray[] = 'Пожалуйста, напишите Ваш комментарий, используя слова';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        } else {
            return true;
        }
    }
}