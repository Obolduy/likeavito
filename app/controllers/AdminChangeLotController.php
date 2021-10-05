<?php
namespace App\Controllers;

use App\Models\Pagination;
use App\Models\LotValidate;
use App\Models\Categories;
use App\Models\LotGet;
use App\Models\LotManipulate;
use App\View\View;

class AdminChangeLotController
{   
    public static function adminShowLotsTable(): void
    {
        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $lots = new Pagination(($_GET['page'] * 5) - 5, 10);
        $lots->pagination((new LotGet)->getAllLots()->queryString);

        new View('adminshowlots', ['lots' => $lots->table, 'page_count' => $lots->pageCount, 'title' => 'Просмотр товаров']);
    }

    public static function adminChangeLot(int $lot_id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = (new Categories)->getAllCategories();
            $lot = (new LotGet)->getFullLotInfo($lot_id);

            new View('adminchangelot', ['lot' => $lot['LotInfo'], 'pictures' => $lot['LotPictures'], 'categories' => $categories, 'title' => 'Изменение товар']);
        } else {
            $check = (new LotValidate)->checkLotData(strip_tags($_POST['title']), strip_tags($_POST['price']));

            if ($_FILES['photos']['size'][0] != 0) {
                $photos = $_FILES['photos'];
            }

            if (is_bool($check)) {
                $display = $_POST['display'] ?? 0;

                (new LotManipulate)->changeLot($lot_id, strip_tags($_POST['title']), strip_tags($_POST['price']),
                    strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'),
                        $_POST['category_id'], $display, $photos, $_POST['photos_radio']);

                header("Location: /admin/change/lot/$lot_id");
            } else {
                $_SESSION['lot_err_msg'] = $check;

                header("Location: /admin/change/lot/$lot_id");
            }
        }
    }
}