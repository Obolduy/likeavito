<?php

require 'C:\OpenServer\domains\likeavito\app\models\Lots.php';

class AddLotController
{   
    public function newLot()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include_once 'C:\OpenServer\domains\likeavito\addlot.php';
        } else {
            if (!is_numeric($_POST['price'])) {
                throw new Exception('Цена должна быть записана числом');

                //
            }
            return Lots::newLot();
        }
    }
}