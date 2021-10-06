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
        $categories = $cache->hmget("lots_categories", "category_1", "category_2", "category_3", "category_4",
            "category_5", "category_6", "category_7", "category_8");

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

        $user = (new UserGet)->getUser($_SESSION['user']['id']);

        $category = $lotGet->getLotsByCategoryId($category_id, $sortBy);
        
        $pagination = new Pagination((($_GET['page'] * 5) - 5));
        $pagination->pagination($category->queryString);
        
        $lots = $lotGet->sortLotsByUserCity($user['city'], $pagination->table);

        $category = $category->fetch();

        new View('showcategory', ['lots' => $lots, 'page_count' => $pagination->pageCount, 'title' => $category['category']]);
    }
}