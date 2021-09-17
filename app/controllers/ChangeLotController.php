<?php
namespace App\Controllers;

use App\Models\LotGet;
use App\Models\Categories;
use App\Models\LotManipulate;
use App\Models\LotValidate;
use App\View\View;

class ChangeLotController
{   
    public static function changeLot(int $lot_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $lot = (new LotGet)->getFullLotInfo($lot_id);
            $categories = (new Categories)->getAllCategories();

            new View('changelot', ['lot' => $lot, 'categories' => $categories, 'title' => 'Изменить товар']);
        } else {
            $check = (new LotValidate)->checkLotData($_POST['title'], $_POST['price']);

            if ($check !== true) {
                $_SESSION['lot_err_msg'] = 'Цена должна быть записана числом';
                
                header("Location: /managelot/$lot_id/change");
            } else {
                (new LotManipulate)->changeLot($lot_id, strip_tags($_POST['title']), strip_tags($_POST['price']),
                    strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'),
                        $_POST['category_id'], $_FILES['photos']);

                header("Location: /category/{$_POST['category_id']}/$lot_id");
            }
        }
    }
}