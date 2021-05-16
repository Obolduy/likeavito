<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class AdminChangeLotController
{   
    public static function adminShowLotsTable(): void
    {
        $lots = (new Lots)->getFullLotInfo();

        new View('adminshowlots', ['lots' => $lots, 'title' => 'Просмотр товаров']);
    }

    public static function adminChangeLot(int $lot_id): void
    {
        $lot = new Lots;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $info = $lot->getOne('lots', $lot_id);
            $categories = $lot->getAll('lots_category');

            new View('adminchangelot', ['info' => $info, 'categories' => $categories, 'title' => 'Изменение товара']);
        } else {
            if (!is_numeric($_POST['price'])) {               
                header("Location: /admin/change/lot/$lot_id");
            }

            if ($_FILES['photos']['name']) {
                $lot->addLotPictures($_FILES['photos'], $lot_id);
            }

            $lot->update("UPDATE lots SET title = ?, price = ?, description = ?, category_id = ?, update_time = now() WHERE id = ?",
                [strip_tags($_POST['title']), strip_tags($_POST['price']),
                    strip_tags($_POST['description']), $_POST['category_id'], $lot_id]);
        }
    }
}