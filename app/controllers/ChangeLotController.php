<?php
namespace App\Controllers;

use App\Models\LotGet;
use App\Models\CategoriesGet;
use App\Models\LotManipulate;
use App\Models\LotValidate;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class ChangeLotController
{   
    public static function changeLot(int $lot_id): void
    {
        $lotGet = new LotGet();

        $lot = $lotGet->getFullLotInfo($lot_id);

        if ($lot['LotInfo']['owner_id'] != $_SESSION['user']['id']) {
            header('Location: /'); die();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = (new CategoriesGet)->getAllCategories();

            new View('changelot', ['lot' => $lot['LotInfo'], 'pictures' => $lot['LotPictures'], 'categories' => $categories, 'title' => 'Изменить товар']);
        } else {
            $check = (new LotValidate)->checkLotData(strip_tags($_POST['title']), strip_tags($_POST['price']));

            if ($check !== true) {
                $_SESSION['lot_err_msg'] = 'Цена должна быть записана числом';
                
                header("Location: /managelot/$lot_id/change");
            } else {
                if ($_FILES['photos']['size'][0] != 0) {
                    $photos = $_FILES['photos'];
                }

                $display = $_POST['display'] ?? 0;

                (new LotManipulate)->changeLot($lot_id, strip_tags($_POST['title']), strip_tags($_POST['price']),
                    strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>'),
                        $_POST['category_id'], $display, $photos, $_POST['photos_radio']);

                $lots = $lotGet->getLotsForCache();
            
                Autoloader::register();
                $cache = new Client();

                for ($i = 1; $i <= 5; $i++) {
                    $cache->hmset("new_lots", [
                        "link_$i" => "<a href=\"/category/{$lots[$i - 1]['category_id']}/{$lots[$i - 1]['id']}\">{$lots[$i - 1]['title']}</a>"
                    ]);
                }

                header("Location: /category/{$_POST['category_id']}/$lot_id");
            }
        }
    }
}