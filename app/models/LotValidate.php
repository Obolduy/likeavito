<?php
namespace App\Models;

class LotValidate
{
    private $errorArray = [];

    public function checkLotData($title, $price)
    {
        if (is_numeric($title)) {
            $this->errorArray[] = 'Название должно быть записано текстом';
        }

        if (!is_numeric($price) || $price == 0) {
            $this->errorArray[] = 'Цена должна быть записана корректным числом';
        }

        if (!empty($this->errorArray)) {
            return $this->errorArray;
        } else {
            return true;
        }
    }
}