<?php
namespace App\Controllers;
use App\Models\Lots;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class AddLotController
{   
    public static function newLot(): void
    {
        $base = new Lots();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = $base->getAll('lots_category');

            new View('addlot', ['categories' => $categories, 'title' => 'Добавление товара']);
        } else {
            $title = strip_tags($_POST['title']);
            $price = strip_tags($_POST['price']);
            $description = strip_tags($_POST['description'], '<p></p><br/><br><i><b><s><u><strong>');
            $category_id = strip_tags($_POST['category_id']);
            $owner_id = $_SESSION['user']['id'];

            if (!self::checkLotData($title, $price)) {
                header('Location: /addlot'); die();
            }

            $base->addLot($title, $price, $description, $category_id, $owner_id);

            $lot = $base->getOne('lots', $owner_id, 'owner_id');

            foreach ($lot as $elem) {
                $id = $elem['id'];
            }

            if ($_FILES['photos']['name'][0]) {
                $photos_names = $base->insertPicture("img/lots/$id", $_FILES['photos']);

                foreach ($photos_names as $photo_name) {
                    $base->addLotPictures($photo_name, $id);
                }
            }

            $lots = $base->getAll('lots', [0, 5], true);
            
            Autoloader::register();
            $cache = new Client();

            for ($i = 1; $i <= 5; $i++) {
                $cache->hmset("new_lots", [
                    "link_$i" => "<a href=\"/category/{$lots[$i - 1]['category_id']}/{$lots[$i - 1]['id']}\">{$lots[$i - 1]['title']}</a>"
                ]);
            }

            header("Location: /category/$category_id/$id");
        }
    }

    public static function checkLotData(string $title, $price): bool
    {
        $error = [];

        if (is_numeric($title)) {
            $error[] = 'Название должно быть записано текстом';
        }

        if (!is_numeric($price) || $price == 0) {
            $error[] = 'Цена должна быть записана корректным числом';
        }

        if ($error) {
            $_SESSION['addlot_err_msg'] = $error;

            return false;
        } else {
            return true;
        } 
    }
}