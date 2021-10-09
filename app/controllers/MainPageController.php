<?php
namespace App\Controllers;

use App\Models\LotGet;
use App\Models\UserGet;
use App\Models\Pagination;
use App\View\View;
use Predis\Autoloader;
use Predis\Client;

class MainPageController
{   
    public static $sortByWhiteList = ['title', 'price', 'city', 'add_time'];

    public static function showLots(): void
    {
        Autoloader::register();
        $cache = new Client();

        $lots = $cache->hmget("new_lots", "link_1", "link_2", "link_3", "link_4", "link_5");
        $categories = $cache->hgetall("lots_categories");

        new View('main', ['lots' => $lots, 'categories' => $categories, 'title' => 'Главная страница']);
    }

    public static function showCategory(int $category_id): void
    {
        $_GET['page'] = (int)$_GET['page'];

        if ($_GET['page'] == 0) {
            $_GET['page'] = 1;
        }

        if (!isset($_GET['page']) || $_GET['page'] == 1) {
            $_GET['page'] = 1;
        }

        $sortBy = $_GET['sort'];

        if (!in_array($sortBy, self::$sortByWhiteList)) {
            $sortBy = null;
        }

        $lotGet = new LotGet();

        $category = $lotGet->getLotsByCategoryId($category_id, $sortBy);
        
        $pagination = new Pagination((($_GET['page'] * 5) - 5));
        $pagination->pagination($category->queryString);
        
        if ($_SESSION['user']) {
            $user = (new UserGet)->getUser($_SESSION['user']['id']);
            $lots = $lotGet->sortLotsByUserCity($user['city'], $pagination->table);
        } else {
            $lots = $pagination->table;
        }
        
        foreach ($lots as $lot) {
            if ($getPic = $lotGet->getLotMainPicture($lot['id'])) {
                $lotsPictures['lot_id'] = $getPic['lot_id'];
                $lotsPictures['picture'] = $getPic['picture'];
                $lotsPictures['id'] = $getPic['id'];
            }
        }
        
        $category = $category->fetch();

        new View('showcategory', ['lots' => $lots, 'lots_pictures' => $lotsPictures, 'page_count' => $pagination->pageCount, 'title' => $category['category']]);
    }
}