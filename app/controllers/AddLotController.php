<?php
namespace App\Controllers;

use App\Models\Categories;
use App\Models\LotGet;
use App\Models\LotManipulate;
use App\Models\LotValidate;
use App\Models\Picture;
use App\Models\PictureDatabase;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class AddLotController
{   
    public static function newLot(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = (new Categories)->getAllCategories();

            new View('addlot', ['categories' => $categories, 'title' => 'Добавление товара']);
        } else {
            $title = strip_tags($_POST['title']);
            $price = strip_tags($_POST['price']);
            $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');
            $categoryId = strip_tags($_POST['category_id']);
            $ownerId = $_SESSION['user']['id'];
            $photos = $_FILES['photos'] ?? null;

            $checkData = (new LotValidate)->checkLotData($title, $price);

            if (is_array($checkData)) {
                $_SESSION['addlot_err_msg'] = $checkData;

                header('Location: /addlot'); die();
            }

            (new LotManipulate)->addLot($title, $price, $description, $categoryId, $ownerId);
            $lotGet = new LotGet();

            $lotId = $lotGet->getUserLots($ownerId);
            $lotId = $lotId[count($lotId) - 1]['id'];

            if ($photos) {
                $pictures = (new Picture)->uploadPicture("lots/$lotId", $_FILES['photos']);
                (new PictureDatabase)->addLotPicture($lotId, $pictures);
            }
            
            $lots = $lotGet->getLotsForCache();
            
            Autoloader::register();
            $cache = new Client();

            for ($i = 1; $i <= 5; $i++) {
                $cache->hmset("new_lots", [
                    "link_$i" => "<a href=\"/category/{$lots[$i - 1]['category_id']}/{$lots[$i - 1]['id']}\">{$lots[$i - 1]['title']}</a>"
                ]);
            }

            header("Location: /category/$categoryId/$lotId");
        }
    }
}