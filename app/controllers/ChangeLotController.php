<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;

class ChangeLotController
{   
    public static function changeLot(int $lot_id): void
    {
        $base = new Lots();
        $lot = $base->getOne('lots', $lot_id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {   
            $categories = $lot->getAll('lots_category');

            new View('changelot', ['lot' => $lot, 'categories' => $categories, 'title' => 'Изменить товар']);
        } else {
            if (!is_numeric(strip_tags($_POST['price']))) {
                echo 'Цена должна быть записана числом';
                
                new View('changelot', ['lot' => $lot, 'title' => 'Изменить товар']);
            }

            if ($_FILES['photos']['name']) {
                $base->addLotPictures($_FILES['photos'], $lot_id);
            }

            $base->update("UPDATE lots SET title = ?, price = ?, description = ?, category_id = ?, update_time = now() WHERE id = ?",
                [strip_tags($_POST['title']), strip_tags($_POST['price']),
                    strip_tags($_POST['description']), $_POST['category_id'], $lot_id]);
        }
    }
}