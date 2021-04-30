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
                if (!is_dir("img/lots/$lot_id")) {
                    mkdir("img/lots/$lot_id");
                }

                $dir = "img/lots/$lot_id";
                $ext = '';

                for ($i = 0; $i <= count($_FILES['photos']); $i++) {
                    preg_match_all('#\.[A-Za-z]{3,4}$#', $_FILES['photos']['name'][$i], $ext);
                    $name = md5($_FILES['photos']['name'][$i]) . $ext[0][0];
                    move_uploaded_file($_FILES['photos']['tmp_name'][$i], "$dir/$name");

                    $lot->addLotPictures($name, $id);
                }
            }

            $lot->update("UPDATE lots SET title = ?, price = ?, description = ?, update_time = now() WHERE id = ?",
                [strip_tags($_POST['title']), strip_tags($_POST['price']), strip_tags($_POST['description']), $lot_id]);
        }
    }
}