<?php
namespace App\Controllers;

use App\Models\MySQLDB;
use App\Models\LotAdd;
use App\Models\LotValidate;
use App\Models\Picture;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class AddLotController
{   
    public static function newLot(): void
    {
        $db = new MySQLDB();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = $db->dbQuery("SELECT * FROM lots_category")->fetchAll();

            new View('addlot', ['categories' => $categories, 'title' => 'Добавление товара']);
        } else {
            $title = strip_tags($_POST['title']);
            $price = strip_tags($_POST['price']);
            $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');
            $categoryId = strip_tags($_POST['category_id']);
            $ownerId = $_SESSION['user_id'];

            $checkData = (new LotValidate)->checkLotData($title, $price);

            if ($checkData) {
                $_SESSION['addlot_err_msg'] = $checkData;

                header('Location: /addlot'); die();
            }

            new LotAdd($title, $price, $description, $categoryId, $ownerId);

            $lotId = $db->dbQuery("SELECT id FROM lots WHERE owner_id = ? ORDER BY id DESC", [$ownerId])
                ->fetchColumn();

            (new Picture)->uploadPicture("lots/$lotId", $_FILES['photos']);

            $lots = $db->dbQuery("SELECT * FROM lots ORDER BY id DESC LIMIT 0,5")->fetchAll();
            
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