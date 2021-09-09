<?php
namespace App\Controllers;

use App\Models\LotGet;
use App\Models\MySQLDB;
use App\Models\LotChange;
use App\View\View;

class ChangeLotController
{   
    public static function changeLot(int $lot_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $lot = (new LotGet)->getFullLotInfo($lot_id);
            $categories = (new MySQLDB)->dbQuery('SELECT * FROM lots_category')->fetchAll();

            new View('changelot', ['lot' => $lot, 'categories' => $categories, 'title' => 'Изменить товар']);
        } else {
            if (!is_numeric(strip_tags($_POST['price']))) {
                $_SESSION['lot_err_msg'] = 'Цена должна быть записана числом';
                
                header("Location: /managelot/$lot_id/change");
            }

            (new LotChange($lot_id))->changeLot(strip_tags($_POST['title']), strip_tags($_POST['price']),
                    strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'),
                        $_POST['category_id'], $_FILES['photos']);
        }
    }
}